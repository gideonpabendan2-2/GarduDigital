<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class LeaderboardController extends Controller
{
    public function index()
    {
        // Ambil top 10 siswa berdasarkan XP
        $topSiswa = Siswa::with('pengguna', 'kelas')->orderBy('xp', 'desc')->take(10)->get();
        return view('siswa.leaderboard.index', compact('topSiswa'));
    }
}
