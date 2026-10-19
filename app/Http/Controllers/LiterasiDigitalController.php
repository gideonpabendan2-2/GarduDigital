<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModulLiterasiDigital;

class LiterasiDigitalController extends Controller
{
    public function indexSiswa()
    {
        $modulList = ModulLiterasiDigital::where('status', true)->get();
        return view('siswa.literasi.index', compact('modulList'));
    }
}
