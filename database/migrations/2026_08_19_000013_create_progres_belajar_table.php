<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('progres_belajar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('materi_id')->constrained('materi')->onDelete('cascade');
            $table->integer('persentase_kemajuan')->default(0);
            $table->enum('status', ['belum_mulai', 'sedang_berjalan', 'selesai'])->default('belum_mulai');
            $table->timestamp('terakhir_diakses_pada')->nullable();
            $table->timestamp('selesai_pada')->nullable();
            $table->timestamps();

            // Memastikan data progres bersifat unik untuk kombinasi siswa dan materi yang sama
            $table->unique(['siswa_id', 'materi_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progres_belajar');
    }
};
