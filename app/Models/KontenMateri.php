<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontenMateri extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'konten_materi';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'materi_id',
        'tipe',
        'judul',
        'konten',
        'path_file',
        'url',
        'nomor_urut',
    ];

    /**
     * Relasi ke model Materi.
     */
    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }
}
