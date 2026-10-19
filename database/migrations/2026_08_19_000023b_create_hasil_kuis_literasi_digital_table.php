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
        Schema::create('hasil_kuis_literasi_digital', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modul_literasi_digital_id')->constrained('modul_literasi_digital')->onDelete('cascade');
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->integer('skor');
            $table->integer('jawaban_benar');
            $table->integer('jawaban_salah');
            $table->timestamp('selesai_pada')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_kuis_literasi_digital');
    }
};
