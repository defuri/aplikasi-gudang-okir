<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     public function handle(Request $request, Closure $next): Response
     {
        $user = Auth::user();

        if (!$user) {
            // Cek apakah ada timestamp aktivitas terakhir
            if (session()->has('last_activity')) {
                // Sesi mungkin habis
                abort(403, 'Sesi Anda telah habis. Silakan login kembali.');
            } else {
                // Pengguna belum pernah login
                abort(403, 'Anda tidak memiliki hak akses.');
            }
        }

        return $next($request);
     }
}
