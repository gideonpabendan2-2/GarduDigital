<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\OrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * Tampilkan formulir tambah pengguna baru.
     */
    public function create()
    {
        return view('admin.pengguna.create');
    }

    /**
     * Simpan pengguna baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:200'],
            'email' => ['required', 'email', 'unique:pengguna,email'],
            'password' => ['required', 'min:6'],
            'peran' => ['required', 'in:siswa,guru,orang_tua,admin'],
        ]);

        $pengguna = Pengguna::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'peran' => $validated['peran'],
            'status' => 'aktif',
        ]);

        // Buat profil kosong terkait peran (jika bukan admin)
        if ($validated['peran'] === 'siswa') {
            Siswa::create([
                'pengguna_id' => $pengguna->id,
                // Default value, bisa diupdate nanti oleh guru/admin
                'kelas_id' => null,
                'nis' => 'TMP-' . rand(1000, 9999), 
                'xp' => 0,
                'level' => 1,
                'streak' => 0,
            ]);
        } elseif ($validated['peran'] === 'guru') {
            Guru::create([
                'pengguna_id' => $pengguna->id,
            ]);
        } elseif ($validated['peran'] === 'orang_tua') {
            OrangTua::create([
                'pengguna_id' => $pengguna->id,
            ]);
        }

        return redirect()->route('dashboard.admin')->with('success', 'Pengguna ' . $pengguna->nama . ' berhasil ditambahkan!');
    }
}
