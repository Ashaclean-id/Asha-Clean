<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // 1. Cek apakah user sudah login?
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Cek apakah role user SESUAI dengan yang diminta (misal: 'admin')
        if (Auth::user()->role !== $role) {
            // Kalau beda, tendang ke halaman home atau tampilkan error 403
            abort(403, 'MAAF, ANDA BUKAN ADMIN! AKSES DITOLAK.');
        }

        return $next($request);
    }
}