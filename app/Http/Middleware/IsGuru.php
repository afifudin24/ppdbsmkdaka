<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsGuru
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      // Cek apakah sudah login dan role == guru
    if (session()->missing('role') || session('role') !== 'guru') {
        // Simpan URL tujuan agar bisa diarahkan kembali setelah login
        session(['url.intended' => $request->url()]);

        return redirect('/auth/guru');
    }

    return $next($request);
    }
}
