<?php

// php artisan make:middleware CheckRole

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  ...$roles (Contoh: 'Customer','Employee', 'Owner')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $userRole = $request->session()->get('peran');
        
        // dd($userRole); // debug

        if (!$userRole) {
             return redirect()->route('login'); // jika tidak punya peran (tamu) paksa login
        }
        // cek $userRole
        if (!in_array(($userRole), $roles)) {
            abort(404);
        }

        // Jika diizinkan (misal: 'employee' ada di ['employee']), biarkan masuk
        return $next($request);
    }
}
