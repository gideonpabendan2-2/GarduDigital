<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'pengguna';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'peran',
        'status',
    ];

    /**
     * Atribut yang disembunyikan untuk serialisasi.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Mendapatkan atribut yang harus di-cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke profil Guru.
     */
    public function guru()
    {
        return $this->hasOne(Guru::class, 'pengguna_id');
    }

    /**
     * Relasi ke profil Siswa.
     */
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'pengguna_id');
    }

    /**
     * Relasi ke profil Orang Tua.
     */
    public function orangTua()
    {
        return $this->hasOne(OrangTua::class, 'pengguna_id');
    }

    /**
     * Relasi ke data Pengumuman yang dibuat oleh pengguna ini.
     */
    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class, 'pengguna_id');
    }
}
