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
        Schema::create('streak_belajar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->date('tanggal_aktivitas');
            $table->integer('xp_diperoleh')->default(0);
            $table->timestamps();
            
            // Unik per siswa per hari agar tidak terduplikasi
            $table->unique(['siswa_id', 'tanggal_aktivitas']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streak_belajar');
    }
};
