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
        Schema::create('kamar_kos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kamar', 255);
            $table->boolean('tersedia')->default(true);
            $table->string('NIK_penduduk')->nullable();
            $table->integer('kapasitas')->default(1);
            $table->foreign('NIK_penduduk')->references('NIK')->on('penduduk')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar_kos');
    }
};
