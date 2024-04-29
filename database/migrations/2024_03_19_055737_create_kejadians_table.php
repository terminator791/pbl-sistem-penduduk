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
        Schema::create('kejadian', function (Blueprint $table) {
            $table->id();
            $table->string('NIK_penduduk');
            $table->unsignedBigInteger('jenis_kejadian');
            $table->date('tanggal_kejadian')->nullable();
            $table->string('tempat_kejadian')->nullable();
            $table->string('foto_kejadian')->nullable();
            $table->string('deskripsi_kejadian')->nullable();
            $table->enum('status', ['proses', 'selesai'])->default('proses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kejadian');
    }
};
