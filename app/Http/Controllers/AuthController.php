<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectBerdasarkanPeran(Auth::user()->peran);
        }
        return view('auth.login');
    }

    /**
     * Memproses otentikasi.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Karena di database kolomnya adalah 'email', kita map input 'username' ke 'email'
        $authData = [
            'email' => $credentials['username'],
            'password' => $credentials['password'],
        ];

        // Cek login
        if (Auth::attempt($authData)) {
            $request->session()->regenerate();

            // Cek apakah akun aktif
            if (Auth::user()->status !== 'aktif') {
                Auth::logout();
                return back()->withErrors([
                    'username' => 'Akun Anda sedang nonaktif. Silakan hubungi admin.',
                ]);
            }

            return $this->redirectBerdasarkanPeran(Auth::user()->peran);
        }

        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    /**
     * Memproses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }

    /**
     * Fungsi pembantu untuk mengarahkan rute berdasarkan peran pengguna.
     */
    private function redirectBerdasarkanPeran($peran)
    {
        switch ($peran) {
            case 'siswa':
                return redirect()->route('dashboard.siswa');
            case 'guru':
                return redirect()->route('dashboard.guru');
            case 'orang_tua':
                return redirect()->route('dashboard.orang_tua');
            case 'admin':
                return redirect()->route('dashboard.admin');
            default:
                return redirect('/');
        }
    }
}
