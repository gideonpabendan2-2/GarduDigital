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
        Schema::create('materi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->foreignId('guru_id')->nullable()->constrained('guru')->onDelete('set null');
            $table->string('judul', 200);
            $table->text('deskripsi')->nullable();
            $table->enum('tingkat_kesulitan', ['dasar', 'menengah', 'lanjutan'])->default('dasar');
            $table->integer('estimasi_waktu')->default(15);
            $table->enum('status', ['draft', 'diterbitkan'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};
