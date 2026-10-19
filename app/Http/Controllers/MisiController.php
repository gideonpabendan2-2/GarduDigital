<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Misi;

class MisiController extends Controller
{
    public function indexSiswa()
    {
        // Dalam implementasi nyata, kita fetch dari table Misi (jika sudah ada seed data)
        // Sementara untuk MVP yang cantik, kita akan pass data statis jika db kosong.
        $misiList = Misi::where('status', 'aktif')->get();
        return view('siswa.misi.index', compact('misiList'));
    }
}
