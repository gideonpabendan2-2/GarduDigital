<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'siswa';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pengguna_id',
        'kelas_id',
        'nis',
        'tanggal_lahir',
        'jenis_kelamin',
        'foto',
        'xp',
        'level',
        'streak',
    ];

    /**
     * Relasi ke model Pengguna (User Account).
     */
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    /**
     * Relasi ke Kelas tempat siswa belajar.
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    /**
     * Relasi ke Orang Tua siswa (Many-to-Many).
     */
    public function orangTua()
    {
        return $this->belongsToMany(OrangTua::class, 'orang_tua_siswa', 'siswa_id', 'orang_tua_id')
                    ->withPivot('hubungan')
                    ->withTimestamps();
    }

    /**
     * Relasi ke hasil percobaan Kuis.
     */
    public function hasilKuis()
    {
        return $this->hasMany(HasilKuis::class, 'siswa_id');
    }

    /**
     * Relasi ke progres penyelesaian materi belajar.
     */
    public function progresBelajar()
    {
        return $this->hasMany(ProgresBelajar::class, 'siswa_id');
    }

    /**
     * Relasi ke pengiriman misi siswa.
     */
    public function pengirimanMisi()
    {
        return $this->hasMany(PengirimanMisi::class, 'siswa_id');
    }

    /**
     * Relasi ke hasil bermain game edukasi.
     */
    public function hasilPermainan()
    {
        return $this->hasMany(HasilPermainan::class, 'siswa_id');
    }

    /**
     * Relasi ke Lencana yang diraih siswa (Many-to-Many).
     */
    public function lencana()
    {
        return $this->belongsToMany(Lencana::class, 'lencana_siswa', 'siswa_id', 'lencana_id')
                    ->withPivot('didapatkan_pada')
                    ->withTimestamps();
    }

    /**
     * Relasi ke rincian transaksi perolehan XP.
     */
    public function transaksiXp()
    {
        return $this->hasMany(TransaksiXp::class, 'siswa_id');
    }

    /**
     * Relasi ke riwayat keaktifan harian (untuk streak).
     */
    public function streakBelajar()
    {
        return $this->hasMany(StreakBelajar::class, 'siswa_id');
    }

    /**
     * Relasi ke hasil kuis literasi digital siswa.
     */
    public function hasilKuisLiterasiDigital()
    {
        return $this->hasMany(HasilKuisLiterasiDigital::class, 'siswa_id');
    }

    /**
     * Relasi ke umpan balik/penilaian materi yang diberikan siswa.
     */
    public function umpanBalik()
    {
        return $this->hasMany(UmpanBalik::class, 'siswa_id');
    }

    /**
     * Relasi ke catatan aktivitas log belajar.
     */
    public function aktivitasBelajar()
    {
        return $this->hasMany(AktivitasBelajar::class, 'siswa_id');
    }

    /**
     * Relasi ke Kelompok belajar siswa (Many-to-Many).
     */
    public function kelompok()
    {
        return $this->belongsToMany(Kelompok::class, 'anggota_kelompok', 'siswa_id', 'kelompok_id')
                    ->withTimestamps();
    }

    /**
     * Menambahkan XP ke siswa, otomatis melakukan kalkulasi kenaikan level,
     * serta mencatat transaksi XP ke database.
     */
    public function tambahXp(int $jumlah, string $tipeSumber, int $idSumber = null, string $deskripsi = '')
    {
        $this->xp += $jumlah;

        // Aturan naik level: Kelipatan 1000 XP (Contoh: Level 1 = 0-999, Level 2 = 1000-1999, dst)
        $levelBaru = floor($this->xp / 1000) + 1;
        
        if ($levelBaru > $this->level) {
            $this->level = $levelBaru;
        }

        $this->save();

        // Catat transaksi XP
        return $this->transaksiXp()->create([
            'tipe_sumber' => $tipeSumber,
            'id_sumber' => $idSumber,
            'xp' => $jumlah,
            'deskripsi' => $deskripsi,
        ]);
    }

    /**
     * Memperbarui streak belajar siswa berdasarkan tanggal hari ini.
     */
    public function updateStreak()
    {
        $hariIni = now()->toDateString();
        $kemarin = now()->subDay()->toDateString();

        // Cari catatan streak belajar terakhir
        $streakTerakhir = $this->streakBelajar()->orderBy('tanggal_aktivitas', 'desc')->first();

        if (!$streakTerakhir) {
            // Belum pernah belajar sama sekali
            $this->streak = 1;
            $this->save();

            $this->streakBelajar()->create([
                'tanggal_aktivitas' => $hariIni,
                'xp_diperoleh' => 0,
            ]);
            return;
        }

        $tanggalTerakhir = $streakTerakhir->tanggal_aktivitas;

        if ($tanggalTerakhir === $hariIni) {
            // Sudah belajar hari ini, streak tidak bertambah ganda
            return;
        }

        if ($tanggalTerakhir === $kemarin) {
            // Belajar kemarin, streak bertambah
            $this->streak += 1;
        } else {
            // Melewatkan hari belajar, streak reset ke 1
            $this->streak = 1;
        }

        $this->save();

        $this->streakBelajar()->create([
            'tanggal_aktivitas' => $hariIni,
            'xp_diperoleh' => 0,
        ]);
    }
}
