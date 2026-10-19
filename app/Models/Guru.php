<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'guru';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pengguna_id',
        'nip',
        'spesialisasi',
        'foto',
    ];

    /**
     * Relasi ke model Pengguna (User Account).
     */
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    /**
     * Relasi ke Kelas yang diajar/dikelola oleh guru.
     */
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'guru_id');
    }

    /**
     * Relasi ke materi pelajaran yang diunggah oleh guru.
     */
    public function materi()
    {
        return $this->hasMany(Materi::class, 'guru_id');
    }

    /**
     * Relasi ke misi mingguan yang dibuat oleh guru.
     */
    public function misi()
    {
        return $this->hasMany(Misi::class, 'guru_id');
    }

    /**
     * Relasi ke umpan balik yang ditujukan kepada guru ini.
     */
    public function umpanBalik()
    {
        return $this->hasMany(UmpanBalik::class, 'guru_id');
    }
}
