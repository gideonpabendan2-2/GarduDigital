<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\OrangTua;
use App\Models\MataPelajaran;
use App\Models\Materi;
use App\Models\KontenMateri;
use App\Models\Kuis;
use App\Models\Pertanyaan;
use App\Models\PilihanJawaban;
use App\Models\ModulLiterasiDigital;
use App\Models\KuisLiterasiDigital;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Admin
        Pengguna::create([
            'nama' => 'Admin Gardu Digital',
            'email' => 'admin@gardudigital.id',
            'password' => Hash::make('admin123'),
            'peran' => 'admin',
            'status' => 'aktif',
        ]);

        // 2. Seed Guru & Profil Guru
        $penggunaGuru = Pengguna::create([
            'nama' => 'Ibu Budi, S.Pd.',
            'email' => 'ibubudi@sekolah.id',
            'password' => Hash::make('guru123'),
            'peran' => 'guru',
            'status' => 'aktif',
        ]);

        $guru = Guru::create([
            'pengguna_id' => $penggunaGuru->id,
            'nip' => '198503102010012003',
            'spesialisasi' => 'Guru Kelas SD',
        ]);

        // 3. Seed Kelas
        $kelas = Kelas::create([
            'nama' => 'Kelas 4A',
            'tingkat' => 4,
            'tahun_ajaran' => '2026/2027',
            'guru_id' => $guru->id,
        ]);

        // 4. Seed Siswa & Profil Siswa
        $penggunaSiswa = Pengguna::create([
            'nama' => 'Gideon',
            'email' => 'gideon@siswa.id',
            'password' => Hash::make('siswa123'),
            'peran' => 'siswa',
            'status' => 'aktif',
        ]);

        $siswa = Siswa::create([
            'pengguna_id' => $penggunaSiswa->id,
            'kelas_id' => $kelas->id,
            'nis' => '12345',
            'tanggal_lahir' => '2016-05-15',
            'jenis_kelamin' => 'L',
            'xp' => 1250,
            'level' => 7,
            'streak' => 5,
        ]);

        // 5. Seed Orang Tua & Hubungkan ke Siswa
        $penggunaOrangTua = Pengguna::create([
            'nama' => 'Pak Joko',
            'email' => 'joko@orangtua.id',
            'password' => Hash::make('ortu123'),
            'peran' => 'orang_tua',
            'status' => 'aktif',
        ]);

        $orangTua = OrangTua::create([
            'pengguna_id' => $penggunaOrangTua->id,
            'nomor_telepon' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 45, Desa Sukamakmur',
        ]);

        // Hubungkan Orang Tua ke Siswa (Anak)
        $orangTua->siswa()->attach($siswa->id, ['hubungan' => 'Ayah']);

        // 6. Seed Mata Pelajaran
        $mapelMatematika = MataPelajaran::create([
            'nama' => 'Matematika',
            'deskripsi' => 'Belajar menghitung angka, operasi hitung pecahan, dan bangun ruang secara seru.',
            'ikon' => 'icon-math.png',
            'status' => true,
        ]);

        $mapelIpas = MataPelajaran::create([
            'nama' => 'IPAS',
            'deskripsi' => 'Ilmu Pengetahuan Alam dan Sosial untuk mengenali lingkungan hidup dan sejarah sekitar.',
            'ikon' => 'icon-science.png',
            'status' => true,
        ]);

        // 7. Seed Materi & Konten Materi
        $materiPecahan = Materi::create([
            'mata_pelajaran_id' => $mapelMatematika->id,
            'guru_id' => $guru->id,
            'judul' => 'Pengenalan Pecahan Senilai',
            'deskripsi' => 'Mari belajar membagi benda secara adil dengan materi pecahan senilai.',
            'tingkat_kesulitan' => 'dasar',
            'estimasi_waktu' => 15,
            'status' => 'diterbitkan',
        ]);

        KontenMateri::create([
            'materi_id' => $materiPecahan->id,
            'tipe' => 'teks',
            'judul' => 'Apa itu Pecahan Senilai?',
            'konten' => 'Pecahan senilai adalah pecahan-pecahan yang bernilai sama apabila dibentuk ke pecahan paling sederhana. Contohnya, 1/2 memiliki nilai yang sama dengan 2/4.',
            'nomor_urut' => 1,
        ]);

        // 8. Seed Kuis untuk Materi Pecahan
        $kuisPecahan = Kuis::create([
            'materi_id' => $materiPecahan->id,
            'judul' => 'Kuis Pecahan Dasar',
            'deskripsi' => 'Uji pemahamanmu tentang bentuk pecahan sederhana.',
            'nilai_kelulusan' => 70,
            'batas_waktu' => 10,
            'percobaan_maksimal' => 3,
            'status' => true,
        ]);

        $pertanyaan1 = Pertanyaan::create([
            'kuis_id' => $kuisPecahan->id,
            'pertanyaan' => 'Pecahan yang senilai dengan 1/2 adalah...',
            'tipe' => 'pilihan_ganda',
            'poin' => 50,
            'nomor_urut' => 1,
        ]);

        PilihanJawaban::create([
            'pertanyaan_id' => $pertanyaan1->id,
            'pilihan' => '2/4',
            'apakah_benar' => true,
        ]);
        PilihanJawaban::create([
            'pertanyaan_id' => $pertanyaan1->id,
            'pilihan' => '2/3',
            'apakah_benar' => false,
        ]);
        PilihanJawaban::create([
            'pertanyaan_id' => $pertanyaan1->id,
            'pilihan' => '3/5',
            'apakah_benar' => false,
        ]);

        $pertanyaan2 = Pertanyaan::create([
            'kuis_id' => $kuisPecahan->id,
            'pertanyaan' => 'Apakah 3/6 senilai dengan 1/2?',
            'tipe' => 'benar_salah',
            'poin' => 50,
            'nomor_urut' => 2,
        ]);

        PilihanJawaban::create([
            'pertanyaan_id' => $pertanyaan2->id,
            'pilihan' => 'Benar',
            'apakah_benar' => true,
        ]);
        PilihanJawaban::create([
            'pertanyaan_id' => $pertanyaan2->id,
            'pilihan' => 'Salah',
            'apakah_benar' => false,
        ]);

        // 9. Seed Modul Literasi Digital & Kuis Literasi Digital
        $modulLiterasi = ModulLiterasiDigital::create([
            'judul' => 'Aman Menggunakan Internet',
            'deskripsi' => 'Yuk belajar cara berselancar di dunia maya dengan aman tanpa membagikan info pribadi.',
            'konten' => 'Ingat anak-anak pintar, jangan pernah membagikan kata sandi (password), foto KTP orang tua, alamat rumah, atau nomor HP kepada orang asing di internet!',
            'thumbnail' => 'icon-safety.png',
            'tingkat_kesulitan' => 'dasar',
            'status' => true,
        ]);

        KuisLiterasiDigital::create([
            'modul_literasi_digital_id' => $modulLiterasi->id,
            'pertanyaan' => 'Budi mendapatkan pesan dari orang tidak dikenal: "Selamat! Kamu mendapat hadiah. Kirim nama, alamat, dan nomor HP orang tua." Apa yang harus Budi lakukan?',
            'pilihan_a' => 'Segera mengirimkan info yang diminta',
            'pilihan_b' => 'Abaikan pesan, lalu laporkan kepada orang tua atau guru',
            'pilihan_c' => 'Balas pesan dan memintanya mengirimkan hadiahnya dulu',
            'pilihan_d' => 'Menyebarkannya ke teman sekelas',
            'jawaban_benar' => 'B',
        ]);
    }
}
