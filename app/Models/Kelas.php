<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'kelas';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'tingkat',
        'tahun_ajaran',
        'guru_id',
    ];

    /**
     * Relasi ke model Guru (Wali Kelas/Pengajar).
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    /**
     * Relasi ke daftar Siswa di kelas ini.
     */
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }

    /**
     * Relasi ke daftar Kelompok belajar di kelas ini.
     */
    public function kelompok()
    {
        return $this->hasMany(Kelompok::class, 'kelas_id');
    }
}
