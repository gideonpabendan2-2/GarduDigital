<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPermainan extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'hasil_permainan';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'permainan_id',
        'siswa_id',
        'skor',
        'waktu_dihabiskan',
        'dimainkan_pada',
    ];

    /**
     * Relasi ke model Permainan.
     */
    public function permainan()
    {
        return $this->belongsTo(Permainan::class, 'permainan_id');
    }

    /**
     * Relasi ke model Siswa.
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
