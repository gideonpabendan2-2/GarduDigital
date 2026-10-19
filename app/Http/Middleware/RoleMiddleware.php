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
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // 2. Periksa apakah peran pengguna sesuai dengan yang dibutuhkan route
        if ($user->peran !== $role) {
            // Jika tidak sesuai, lemparkan kembali ke dashboard masing-masing
            switch ($user->peran) {
                case 'siswa':
                    return redirect()->route('dashboard.siswa');
                case 'guru':
                    return redirect()->route('dashboard.guru');
                case 'orang_tua':
                    return redirect()->route('dashboard.orang_tua');
                case 'admin':
                    return redirect()->route('dashboard.admin');
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['error' => 'Peran tidak valid.']);
            }
        }

        return $next($request);
    }
}
