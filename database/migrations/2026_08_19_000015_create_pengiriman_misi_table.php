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
        Schema::create('pengiriman_misi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('misi_id')->constrained('misi')->onDelete('cascade');
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('kelompok_id')->nullable()->constrained('kelompok')->onDelete('set null');
            $table->longText('jawaban');
            $table->string('path_file', 255)->nullable();
            $table->integer('skor')->nullable();
            $table->text('umpan_balik')->nullable();
            $table->enum('status', ['dikirim', 'ditinjau', 'revisi', 'disetujui'])->default('dikirim');
            $table->timestamp('dikirim_pada');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman_misi');
    }
};
