<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lencana extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'lencana';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'deskripsi',
        'ikon',
        'tipe_syarat',
        'nilai_syarat',
    ];

    /**
     * Relasi ke daftar Siswa yang telah memperoleh lencana ini (Many-to-Many).
     */
    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'lencana_siswa', 'lencana_id', 'siswa_id')
                    ->withPivot('didapatkan_pada')
                    ->withTimestamps();
    }
}
