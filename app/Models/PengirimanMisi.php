<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanMisi extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'pengiriman_misi';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'misi_id',
        'siswa_id',
        'kelompok_id',
        'jawaban',
        'path_file',
        'skor',
        'umpan_balik',
        'status',
        'dikirim_pada',
    ];

    /**
     * Relasi ke model Misi.
     */
    public function misi()
    {
        return $this->belongsTo(Misi::class, 'misi_id');
    }

    /**
     * Relasi ke model Siswa (pengirim).
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    /**
     * Relasi ke model Kelompok (jika pengiriman berbasis kelompok).
     */
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'kelompok_id');
    }
}
