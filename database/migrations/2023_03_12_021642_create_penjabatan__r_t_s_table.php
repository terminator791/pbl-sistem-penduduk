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
        Schema::create('penjabatan_rt', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penjabatan')->unique();
            $table->unsignedBigInteger('id_rt');
            $table->string('NIK_ketua_rt');
            $table->date('tanggal_dilantik');
            $table->date('tanggal_diberhentikan')->nullable();
            $table->string('foto_ketua_rt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjabatan_rt');
    }
};
