<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'mata_pelajaran';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'deskripsi',
        'ikon',
        'status',
    ];

    /**
     * Relasi ke daftar Materi di bawah mata pelajaran ini.
     */
    public function materi()
    {
        return $this->hasMany(Materi::class, 'mata_pelajaran_id');
    }

    /**
     * Relasi ke daftar Misi di bawah mata pelajaran ini.
     */
    public function misi()
    {
        return $this->hasMany(Misi::class, 'mata_pelajaran_id');
    }

    /**
     * Relasi ke daftar Permainan di bawah mata pelajaran ini.
     */
    public function permainan()
    {
        return $this->hasMany(Permainan::class, 'mata_pelajaran_id');
    }
}
