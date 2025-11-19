<?php

namespace App\Http\Controllers;

// 1. Kita "impor" alat-alat yang kita butuhkan
use Illuminate\Http\Request; // Untuk mengambil data dari form
use App\Models\Menu;    // Untuk berinteraksi dengan tabel 'users'
use App\Models\Table;    // Untuk berinteraksi dengan tabel 'users'
use Illuminate\Support\Facades\Session; // import session

use function Pest\Laravel\session as LaravelSession;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservationData = session()->get('cart.reservation', []);
        $itemsData = session()->get('cart.items', []);
        $tables = Table::all();
        $selectedTable = session()->get('cart.selected_table');
        $totalPrice = 0;

        if ($reservationData) {
            $totalPriceTable = $reservationData['total_price'];
            $totalPrice += $totalPriceTable;
        }

        if ($itemsData) {
            $totalPriceItems = 0;
            foreach ($itemsData as $item) {
                $totalPriceItems += ($item['qty']) * ($item['harga']);
            }
            $totalPrice += $totalPriceItems;
        }

        return view('cart', [
            'title' => 'My Cart Page',
            'reservationData' => $reservationData,
            'itemsData' => $itemsData,
            'totalPrice' => $totalPrice,
            'tables' => $tables,
            'selectedTable' => $selectedTable
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $qty = $request->qty;

        // Ambil 'items' dari 'cart', BUKAN 'cart' langsung
        $cartItems = session()->get('cart.items', []);

        if ($qty > 0) { // jika qty > 0, tambah/update ke keranjang
            $menu = Menu::find($id);
            $cartItems[$id] = [
                'menu_id' => $menu->menu_id,
                'nama' => $menu->nama,
                'nama_gambar' => $menu->nama_gambar,
                'harga' => $menu->harga,
                'qty' => $qty

            ];
        } else { // jika qty 0, hapus dari keranjang
            if (isset($cartItems[$id])) {
                unset($cartItems[$id]);
            }
        }

        // Simpan kembali ke 'cart.items'
        session()->put('cart.items', $cartItems);

        // hitung total harga dan quantity dalam keranjang untuk data FE
        $itemsQty = 0;
        $itemsPrice = 0;

        foreach ($cartItems as $item) {
            $itemsQty += $item['qty'];
            $itemsPrice += ($item['qty'] * $item['harga']);
        }

        // ambil total reservasi dari session
        $reservation = session('cart.reservation');
        $reservationPrice = $reservation['total_price'] ?? 0;

        if ($reservation) {
            $itemsQty += 1; // +1 untuk item meja
        }

        // hitung total items dan reservation
        $grandTotal = $itemsPrice + $reservationPrice;

        // kirim json
        return response()->json([
            'success' => true,
            'totalQty' => $itemsQty, // Badge keranjang (hanya hitung menu)
            'totalPrice' => number_format($grandTotal, 0, ',', '.') // Badge keranjang (total harga keranjang)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $table_id = $request->input('table_id');
        $menu_id = $request->input('menu_id');

        if ($table_id) {
            session()->forget('cart.reservation');
        } else {
            $cartItems = session()->get('cart.items', []);
            if (isset($cartItems[$menu_id])) {
                unset($cartItems[$menu_id]);
            }
            session()->put('cart.items', $cartItems);
        }

        return redirect()->route('customer.cart')->with('success', 'Item berhasil dihapus');
    }

    public function selectTable(Request $request)
    {
        $request->validate([
            'table_id' => 'required|integer',
            'table_name' => 'required|string'
        ]);

        $tableId = $request->input('table_id');
        $tableName = $request->input('table_name');

        session()->put('cart.selected_table', [
            'table_id' => $tableId,
            'nama' => $tableName
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Meja Berhasil dipilih',
            'data' => [
                'table_id' => $tableId,
                'nama' => $tableName
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
}
