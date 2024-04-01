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
        Schema::create('kos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rt');
            $table->string('pemilik_kos');
            $table->string('nama_kos');
            $table->string('alamat_kos');
            $table->integer('jumlah_penghuni');
            $table->string('no_hp_pemilik')->nullable();
            $table->string('email_pemilik')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kos');
    }
};
