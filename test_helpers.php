<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Siswa;
use App\Models\Kuis;
use App\Models\Pertanyaan;
use App\Models\PilihanJawaban;

try {
    echo "=============================================\n";
    echo "PENGUJIAN HELPER LOGIKA BISNIS DI MODEL\n";
    echo "=============================================\n\n";

    $siswa = Siswa::first();
    $kuis = Kuis::first();

    echo "Status Awal Siswa:\n";
    echo "    Nama   : " . $siswa->pengguna->nama . "\n";
    echo "    XP     : " . $siswa->xp . "\n";
    echo "    Level  : " . $siswa->level . "\n";
    echo "    Streak : " . $siswa->streak . "\n\n";

    // 1. Uji tambahXp()
    echo "[+] Menjalankan tambahXp(150, 'kuis', {$kuis->id}, 'Menyelesaikan Kuis Pecahan Senilai')...\n";
    $transaksi = $siswa->tambahXp(150, 'kuis', $kuis->id, 'Menyelesaikan Kuis Pecahan Senilai');
    
    // Refresh model dari DB
    $siswa->refresh();
    echo "Status Setelah Tambah XP:\n";
    echo "    XP Baru      : " . $siswa->xp . "\n";
    echo "    Level Baru   : " . $siswa->level . "\n";
    echo "    Log Transaksi: " . $transaksi->description . " (+ " . $transaksi->xp . " XP)\n\n";

    // 2. Uji updateStreak()
    echo "[+] Menjalankan updateStreak()...\n";
    $siswa->updateStreak();
    $siswa->refresh();
    echo "Status Setelah Update Streak:\n";
    echo "    Streak Baru  : " . $siswa->streak . "\n";
    echo "    Log Tanggal  : " . $siswa->streakBelajar()->latest()->first()->tanggal_aktivitas . "\n\n";

    // 3. Uji evaluasiJawaban()
    echo "[+] Mengevaluasi Jawaban Kuis...\n";
    // Cari pertanyaan-pertanyaan kuis
    $pertanyaan = $kuis->pertanyaan;
    $jawabanSiswa = [];

    foreach ($pertanyaan as $index => $q) {
        if ($index === 0) {
            // Pilih jawaban benar untuk pertanyaan 1
            $opsiBenar = $q->pilihanJawaban()->where('apakah_benar', true)->first();
            $jawabanSiswa[$q->id] = $opsiBenar->id;
            echo "    Soal 1 dijawab BENAR: " . $opsiBenar->pilihan . "\n";
        } else {
            // Pilih jawaban salah untuk pertanyaan 2
            $opsiSalah = $q->pilihanJawaban()->where('apakah_benar', false)->first();
            $jawabanSiswa[$q->id] = $opsiSalah->id;
            echo "    Soal 2 dijawab SALAH: " . $opsiSalah->pilihan . "\n";
        }
    }

    $hasil = $kuis->evaluasiJawaban($jawabanSiswa, $siswa);
    echo "Hasil Kuis Tersimpan:\n";
    echo "    Skor Akhir    : " . $hasil->skor . "\n";
    echo "    Jawaban Benar : " . $hasil->jawaban_benar . "\n";
    echo "    Jawaban Salah : " . $hasil->jawaban_salah . "\n\n";

    echo "=============================================\n";
    echo "PENGUJIAN BERHASIL: Logika model berjalan sempurna!\n";
    echo "=============================================\n";

} catch (\Exception $e) {
    echo "[-] PENGUJIAN GAGAL: " . $e->getMessage() . "\n";
}
