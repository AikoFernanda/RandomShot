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
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $qty = $request->qty;

        $cart = Session()->get('cart', []);

        if ($qty > 0) { // jika qty > 0, tambah/update ke keranjang
            $menu = Menu::find($id);

            $cart[$id] = [
                'id' => $menu->menu_id,
                'nama' => $menu->nama,
                'harga' => $menu->harga,
                'qty' => $qty
            ];
        } else { // jika qty 0, hapus dari keranjang
            if (isset($cart[$id])) {
                unset($cart[$id]);
            }
        }

        // Simpan kembali ke session
        Session()->put('cart', $cart);

        // hitung total harga dan quantity dalam keranjang untuk data FE
        $totalQty = 0;
        $totalPrice = 0;

        foreach ($cart as $item) {
            $totalQty += $item['qty'];
            $totalPrice += ($item['qty'] * $item['harga']);
        }

        // kirim json
        return response()->json([
            'success' => true,
            'totalQty' => $totalQty,
            'totalPrice' => number_format($totalPrice, 0, ',', '.')
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
