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
        Schema::create('lencana', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->text('deskripsi');
            $table->string('ikon', 255);
            $table->string('tipe_syarat', 50);
            $table->integer('nilai_syarat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lencana');
    }
};
