<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'pertanyaan';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kuis_id',
        'pertanyaan',
        'tipe',
        'poin',
        'nomor_urut',
    ];

    /**
     * Relasi ke model Kuis.
     */
    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'kuis_id');
    }

    /**
     * Relasi ke daftar Pilihan Jawaban dari pertanyaan ini.
     */
    public function pilihanJawaban()
    {
        return $this->hasMany(PilihanJawaban::class, 'pertanyaan_id');
    }
}
