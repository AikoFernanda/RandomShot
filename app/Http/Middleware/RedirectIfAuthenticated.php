<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // 1. Cek apakah user sudah login (menurut sistem session manual Anda)
        if ($request->session()->has('peran')) {
            
            // 2. Jika sudah login, ambil perannya
            $peran = $request->session()->get('peran');

            // 3. Tentukan tujuan redirect berdasarkan peran
            // (Gunakan nama peran persis seperti di DB/Sesi Anda, misal 'Customer')
            
            if ($peran == 'Customer') {
                return redirect()->route('home'); // Arahkan Customer ke home
            }
            
            if ($peran == 'Employee') {
                return redirect()->route('admin.reservation'); // Arahkan Employee ke admin
            }

            if ($peran == 'Owner') {
                // Ganti 'owner.laporan' dengan nama rute Anda yang sebenarnya
                return redirect()->route('owner.laporan'); 
            }

            // Fallback (jika peran tidak dikenal, tendang ke home)
            return redirect('/home');
        }

        // 4. Jika BELUM login (peran = null), biarkan dia masuk
        // (Misal: biarkan dia melihat halaman /login)
        return $next($request);
    }
}