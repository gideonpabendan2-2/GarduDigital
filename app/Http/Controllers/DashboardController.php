<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan Dashboard Petualangan Belajar untuk Siswa.
     */
    public function indexSiswa()
    {
        $pengguna = Auth::user();
        $siswa = $pengguna->siswa;

        if ($siswa) {
            // Update streak belajar otomatis ketika siswa membuka dashboard hari ini
            $siswa->updateStreak();
        }

        // Ambil semua mata pelajaran yang aktif
        $mataPelajaran = \App\Models\MataPelajaran::where('status', 'aktif')->get();

        return view('dashboard.siswa', compact('pengguna', 'siswa', 'mataPelajaran'));
    }

    /**
     * Menampilkan Dashboard Analitik untuk Guru.
     */
    public function indexGuru()
    {
        $pengguna = Auth::user();
        $guru = $pengguna->guru;

        // Ambil kelas yang diampu guru ini beserta siswanya
        $kelas = \App\Models\Kelas::where('guru_id', $guru->id)->with('siswa.pengguna')->first();
        
        $totalSiswa = 0;
        $daftarSiswa = [];
        
        if ($kelas) {
            $totalSiswa = $kelas->siswa->count();
            // Urutkan siswa berdasarkan XP terbanyak (Leaderboard Mini)
            $daftarSiswa = $kelas->siswa->sortByDesc('xp');
        }

        return view('dashboard.guru', compact('pengguna', 'guru', 'kelas', 'totalSiswa', 'daftarSiswa'));
    }

    /**
     * Menampilkan Dashboard Pantauan untuk Orang Tua.
     */
    public function indexOrangTua()
    {
        $pengguna = Auth::user();
        $orangTua = $pengguna->orangTua;

        // Ambil data anak (Siswa)
        $anak = \App\Models\Siswa::with(['pengguna', 'kelas', 'sekolah', 'transaksiXp' => function($query) {
            $query->latest()->take(5); // Ambil 5 aktivitas terbaru
        }])->where('orang_tua_id', $orangTua->id)->first();

        return view('dashboard.orang_tua', compact('pengguna', 'orangTua', 'anak'));
    }

    /**
     * Menampilkan Dashboard Sistem untuk Admin.
     */
    public function indexAdmin()
    {
        $pengguna = Auth::user();
        
        $stats = [
            'total_pengguna' => \App\Models\Pengguna::count(),
            'siswa_aktif' => \App\Models\Siswa::count(),
            'total_guru' => \App\Models\Guru::count(),
            'total_materi' => \App\Models\Materi::count(),
        ];

        return view('dashboard.admin', compact('pengguna', 'stats'));
    }
}
