<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reservation; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Nanti di sini Anda akan mengambil data dari database
        // $dataReservasi = Reservasi::all();
        
        // Sekarang, kita hanya tampilkan view-nya
        return view('admin.reservation_data', [
            'title' => 'Data Reservasi'
            // 'reservasi' => $dataReservasi  // (ini untuk nanti)
        ]);
    }
}
