<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'kuis';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'materi_id',
        'judul',
        'deskripsi',
        'nilai_kelulusan',
        'batas_waktu',
        'percobaan_maksimal',
        'status',
    ];

    /**
     * Relasi ke model Materi.
     */
    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }

    /**
     * Relasi ke daftar Pertanyaan kuis.
     */
    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class, 'kuis_id');
    }

    /**
     * Relasi ke hasil Kuis siswa.
     */
    public function hasilKuis()
    {
        return $this->hasMany(HasilKuis::class, 'kuis_id');
    }

    /**
     * Mengevaluasi jawaban kuis yang dikirimkan oleh siswa, menghitung skor,
     * serta menyimpan hasilnya ke tabel hasil_kuis.
     *
     * @param array $jawabanSiswa Format: [pertanyaan_id => pilihan_jawaban_id]
     * @param Siswa $siswa
     * @return HasilKuis
     */
    public function evaluasiJawaban(array $jawabanSiswa, Siswa $siswa)
    {
        $totalPertanyaan = $this->pertanyaan()->count();
        $jawabanBenar = 0;
        $jawabanSalah = 0;

        foreach ($this->pertanyaan as $itemPertanyaan) {
            $idPertanyaan = $itemPertanyaan->id;
            
            // Periksa apakah siswa menjawab pertanyaan ini
            if (isset($jawabanSiswa[$idPertanyaan])) {
                $idPilihan = $jawabanSiswa[$idPertanyaan];
                
                // Cari opsi jawaban yang dipilih
                $opsi = PilihanJawaban::where('pertanyaan_id', $idPertanyaan)
                                      ->where('id', $idPilihan)
                                      ->first();
                                      
                if ($opsi && $opsi->apakah_benar) {
                    $jawabanBenar++;
                } else {
                    $jawabanSalah++;
                }
            } else {
                $jawabanSalah++; // Tidak dijawab dianggap salah
            }
        }

        // Hitung skor (Skor maksimal 100)
        $skor = $totalPertanyaan > 0 ? round(($jawabanBenar / $totalPertanyaan) * 100) : 0;

        // Simpan hasil kuis
        return $this->hasilKuis()->create([
            'siswa_id' => $siswa->id,
            'skor' => $skor,
            'jawaban_benar' => $jawabanBenar,
            'jawaban_salah' => $jawabanSalah,
            'mulai_pada' => now(),
            'selesai_pada' => now(),
        ]);
    }
}
