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
        Schema::create('konten_materi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materi_id')->constrained('materi')->onDelete('cascade');
            $table->enum('tipe', ['teks', 'gambar', 'video', 'audio', 'pdf', 'animasi']);
            $table->string('judul', 200);
            $table->longText('konten')->nullable();
            $table->string('path_file', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->integer('nomor_urut')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konten_materi');
    }
};
