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
        Schema::create('hasil_permainan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permainan_id')->constrained('permainan')->onDelete('cascade');
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->integer('skor')->default(0);
            $table->integer('waktu_dihabiskan')->nullable();
            $table->timestamp('dimainkan_pada');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_permainan');
    }
};
