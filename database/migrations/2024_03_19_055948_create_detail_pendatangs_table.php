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
        Schema::create('detail_pendatang', function (Blueprint $table) {
            $table->id();
            $table->string('NIK')->unique();
            $table->unsignedBigInteger('id_kos');
            $table->date('tanggal_masuk')->default(now());
            $table->date('tanggal_keluar')->nullable();
            $table->string('deskripsi')->nullable();
            $table->unsignedBigInteger('id_kamar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pendatang');
    }
};
