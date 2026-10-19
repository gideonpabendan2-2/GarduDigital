<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresBelajar extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'progres_belajar';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'siswa_id',
        'materi_id',
        'persentase_kemajuan',
        'status',
        'terakhir_diakses_pada',
        'selesai_pada',
    ];

    /**
     * Relasi ke model Siswa.
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    /**
     * Relasi ke model Materi.
     */
    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }
}
