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
        Schema::create('tabel_kos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rt');
            $table->string('pemilik_kos');
            $table->string('NIK_pemilik_kos')->nullable();
            $table->string('nama_kos')->nullable();
            $table->string('alamat_kos')->nullable();
            $table->string('no_hp_pemilik')->nullable();
            $table->string('email_pemilik')->nullable();
            $table->string('foto_kos')->nullable();
            $table->boolean('status')->default(true);
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
