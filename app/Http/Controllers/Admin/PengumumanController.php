<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengumumanController extends Controller
{
    /**
     * Tampilkan formulir buat pengumuman.
     */
    public function create()
    {
        return view('admin.pengumuman.create');
    }

    /**
     * Simpan pengumuman baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:200'],
            'konten' => ['required', 'string'],
            'target' => ['required', 'in:semua,siswa,guru,orang_tua'],
        ]);

        DB::table('pengumuman')->insert([
            'pengguna_id' => Auth::id(),
            'judul' => $validated['judul'],
            'konten' => $validated['konten'],
            'target' => $validated['target'],
            'diterbitkan_pada' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard.admin')->with('success', 'Pengumuman berhasil dipublikasikan ke ' . ucfirst($validated['target']) . '!');
    }
}
