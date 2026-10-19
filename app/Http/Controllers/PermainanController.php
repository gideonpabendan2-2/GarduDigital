<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permainan;

class PermainanController extends Controller
{
    public function indexSiswa()
    {
        $permainanList = Permainan::where('status', 'aktif')->get();
        return view('siswa.bermain.index', compact('permainanList'));
    }
}
