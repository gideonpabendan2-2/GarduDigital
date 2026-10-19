<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuisLiterasiDigital extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'kuis_literasi_digital';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'modul_literasi_digital_id',
        'pertanyaan',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'jawaban_benar',
    ];

    /**
     * Relasi ke model ModulLiterasiDigital.
     */
    public function modulLiterasiDigital()
    {
        return $this->belongsTo(ModulLiterasiDigital::class, 'modul_literasi_digital_id');
    }
}
