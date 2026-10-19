<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permainan extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'permainan';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mata_pelajaran_id',
        'judul',
        'deskripsi',
        'tipe_permainan',
        'tingkat_kesulitan',
        'hadiah_xp',
        'url_permainan',
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
     * Relasi ke riwayat hasil permainan.
     */
    public function hasilPermainan()
    {
        return $this->hasMany(HasilPermainan::class, 'permainan_id');
    }
}
