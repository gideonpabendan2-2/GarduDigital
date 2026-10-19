<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\Kuis;
use Illuminate\Support\Facades\Auth;

class BelajarController extends Controller
{
    /**
     * Menampilkan peta petualangan untuk mata pelajaran tertentu.
     */
    public function petaMateri($id)
    {
        // Ambil mapel beserta materinya
        $mapel = MataPelajaran::with('materi')->findOrFail($id);
        $siswa = Auth::user()->siswa;
        
        return view('belajar.peta', compact('mapel', 'siswa'));
    }

    /**
     * Menampilkan antarmuka kuis interaktif.
     */
    public function mulaiKuis($id)
    {
        $kuis = Kuis::with('pertanyaan.pilihanJawaban')->findOrFail($id);
        
        return view('belajar.kuis', compact('kuis'));
    }

    /**
     * Memproses jawaban kuis dan mengevaluasinya.
     */
    public function submitKuis(Request $request, $id)
    {
        $kuis = Kuis::findOrFail($id);
        $siswa = Auth::user()->siswa;
        
        // Data input format dari form: name="jawaban[pertanyaan_id]" value="pilihan_id"
        $jawaban = $request->input('jawaban', []);
        
        $hasil = $kuis->evaluasiJawaban($jawaban, $siswa);
        
        // Jika lulus, tambah XP (misalnya 150 XP per kuis)
        $xpDiperoleh = 0;
        if ($hasil->skor >= $kuis->nilai_kelulusan) {
            $xpDiperoleh = 150;
            $siswa->tambahXp($xpDiperoleh, 'kuis', $kuis->id, 'Menyelesaikan Kuis: ' . $kuis->judul);
        }

        // Kembali ke dashboard dengan notifikasi hasil
        return redirect()->route('dashboard.siswa')->with('hasil_kuis', [
            'judul' => $kuis->judul,
            'skor' => $hasil->skor,
            'xp' => $xpDiperoleh
        ]);
    }
}
