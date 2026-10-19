<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulLiterasiDigital extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'modul_literasi_digital';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'deskripsi',
        'konten',
        'thumbnail',
        'tingkat_kesulitan',
        'status',
    ];

    /**
     * Relasi ke daftar Pertanyaan Kuis Literasi Digital.
     */
    public function kuisLiterasiDigital()
    {
        return $this->hasMany(KuisLiterasiDigital::class, 'modul_literasi_digital_id');
    }

    /**
     * Relasi ke hasil kuis literasi digital siswa.
     */
    public function hasilKuisLiterasiDigital()
    {
        return $this->hasMany(HasilKuisLiterasiDigital::class, 'modul_literasi_digital_id');
    }
}
