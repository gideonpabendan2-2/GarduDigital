<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Misi extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'misi';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mata_pelajaran_id',
        'guru_id',
        'judul',
        'deskripsi',
        'instruksi',
        'hadiah_xp',
        'tanggal_mulai',
        'tanggal_selesai',
        'tipe',
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
     * Relasi ke model Guru pembuat misi.
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    /**
     * Relasi ke daftar pengiriman/pengumpulan misi siswa.
     */
    public function pengirimanMisi()
    {
        return $this->hasMany(PengirimanMisi::class, 'misi_id');
    }
}
