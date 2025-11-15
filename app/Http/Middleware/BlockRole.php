<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockRole
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user punya peran di sesi
        if ($request->session()->has('peran')) {

            // 2. Ambil nilainya (GET, bukan HAS)
            $userRole = $request->session()->get('peran');

            // 3. Cek peran (Gunakan huruf besar sesuai DB Anda)
            if ($userRole === 'Employee') {
                
                // Arahkan Employee ke dashboard-nya
                return redirect()->route('admin.reservation'); 
            
            } else if ($userRole === 'Owner') {
                
                // Arahkan Owner ke dashboard-nya
                // (Pastikan nama rute 'owner.performance' sudah ada)
                return redirect()->route('owner.performance'); 
            }
            
            // Jika perannya 'Customer', jangan lakukan apa-apa, biarkan lanjut
        }

        // 4. Jika dia Tamu (null) atau Customer, biarkan dia melihat halaman
        return $next($request);
    }
}