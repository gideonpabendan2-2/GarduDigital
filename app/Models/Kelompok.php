<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'kelompok';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_kelompok',
        'kelas_id',
    ];

    /**
     * Relasi ke Kelas tempat kelompok terdaftar.
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    /**
     * Relasi ke daftar anggota kelompok / Siswa (Many-to-Many).
     */
    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'anggota_kelompok', 'kelompok_id', 'siswa_id')
                    ->withTimestamps();
    }

    /**
     * Relasi ke daftar pengiriman misi kelompok.
     */
    public function pengirimanMisi()
    {
        return $this->hasMany(PengirimanMisi::class, 'kelompok_id');
    }
}
