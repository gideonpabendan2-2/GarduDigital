<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilKuis extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'hasil_kuis';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kuis_id',
        'siswa_id',
        'skor',
        'jawaban_benar',
        'jawaban_salah',
        'mulai_pada',
        'selesai_pada',
    ];

    /**
     * Relasi ke model Kuis.
     */
    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'kuis_id');
    }

    /**
     * Relasi ke model Siswa.
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
