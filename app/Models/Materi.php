<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'materi';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mata_pelajaran_id',
        'guru_id',
        'judul',
        'deskripsi',
        'tingkat_kesulitan',
        'estimasi_waktu',
        'status',
    ];

    /**
     * Relasi ke model MataPelajaran.
     */
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    /**
     * Relasi ke model Guru pengunggah materi.
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    /**
     * Relasi ke daftar Konten Media di bawah materi ini.
     */
    public function kontenMateri()
    {
        return $this->hasMany(KontenMateri::class, 'materi_id');
    }

    /**
     * Relasi ke daftar Kuis untuk materi ini.
     */
    public function kuis()
    {
        return $this->hasMany(Kuis::class, 'materi_id');
    }

    /**
     * Relasi ke progres belajar siswa untuk materi ini.
     */
    public function progresBelajar()
    {
        return $this->hasMany(ProgresBelajar::class, 'materi_id');
    }

    /**
     * Relasi ke umpan balik penilaian materi dari siswa.
     */
    public function umpanBalik()
    {
        return $this->hasMany(UmpanBalik::class, 'materi_id');
    }
}
