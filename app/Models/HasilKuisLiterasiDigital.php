<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilKuisLiterasiDigital extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'hasil_kuis_literasi_digital';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'modul_literasi_digital_id',
        'siswa_id',
        'skor',
        'jawaban_benar',
        'jawaban_salah',
        'selesai_pada',
    ];

    /**
     * Relasi ke model ModulLiterasiDigital.
     */
    public function modulLiterasiDigital()
    {
        return $this->belongsTo(ModulLiterasiDigital::class, 'modul_literasi_digital_id');
    }

    /**
     * Relasi ke model Siswa.
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
