<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon; // Import Carbon untuk urusan waktu

class ReservationController extends Controller
{
    /**
     * Menampilkan daftar reservasi
     */
    public function index(Request $request)
    {
        // FITUR AUTO-COMPLETE (OTOMATIS SELESAI) 
        // Cari reservasi yang statusnya belum 'Selesai' (Menunggu atau Checked-in)
        // tapi waktu selesainya sudah lewat dari sekarang.
        Reservation::whereIn('status_reservasi', ['Menunggu Check-in', 'Checked-in'])
            ->where('tanggal_reservasi', '<=', Carbon::now()->format('Y-m-d')) // Tanggal hari ini atau lampau
            ->where(function ($q) {
                // Logika waktu: Kalau tanggalnya hari ini, cek jamnya. Kalau tanggal lampau, pasti lewat.
                $q->where('tanggal_reservasi', '<', Carbon::now()->format('Y-m-d'))
                    ->orWhere(function ($subQ) {
                        // Ambil waktu sekarang
                        $now = Carbon::now();

                        $subQ->where('tanggal_reservasi', $now->format('Y-m-d'))
                            // Kirim Carbon object utuh, biar Laravel yang atur formatnya jadi Y-m-d H:i:s
                            ->where('waktu_selesai', '<', $now);
                    });
            })
            ->update(['status_reservasi' => 'Selesai']);

        // Query Data untuk Ditampilkan
        $query = Reservation::with(['transaction.customer', 'table']);

        $query->whereHas('transaction', function ($q) {
            $q->where('status_transaksi', 'Paid');
        });

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('transaction', function ($subQ) use ($search) {
                    $subQ->where('no_invoice', 'like', "%{$search}%");
                })
                    ->orWhereHas('transaction.customer', function ($subQ) use ($search) {
                        $subQ->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        $query->orderBy('tanggal_reservasi', 'desc')->orderBy('waktu_mulai', 'desc');
        $reservations = $query->paginate(10)->withQueryString();

        return view('admin.reservation_data', [
            'title' => 'Data Reservasi Meja',
            'reservations' => $reservations
        ]);
    }

    /**
     * Update Status via AJAX
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $reservation = Reservation::with('transaction')->findOrFail($id);
            $oldStatus = $reservation->status_reservasi;
            $newStatus = $request->status;

            // VALIDASI ALUR MAJU

            // Jika sudah SELESAI, tidak bisa diapa-apain lagi.
            if ($oldStatus == 'Selesai') {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal: Reservasi sudah selesai, tidak dapat diubah.'
                ], 400);
            }

            // Jika sudah CHECKED-IN, tidak bisa balik ke MENUNGGU.
            if ($oldStatus == 'Checked-in' && $newStatus == 'Menunggu Check-in') {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal: Status Checked-in tidak bisa dikembalikan ke Menunggu.'
                ], 400);
            }

            $request->validate([
                'status' => ['required', Rule::in(['Menunggu Check-in', 'Checked-in', 'Selesai'])],
            ]);

            // Simpan perubahan
            $reservation->status_reservasi = $newStatus;
            $reservation->save();

            // Trigger Menu (Checked-in -> Menu dibuat)
            if ($newStatus == 'Checked-in') {
                if ($reservation->transaction) {
                    $reservation->transaction->transactionDetails()
                        ->where('status_pesanan', 'Dijadwalkan')
                        ->update(['status_pesanan' => 'Menunggu Dibuat']);
                }
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
