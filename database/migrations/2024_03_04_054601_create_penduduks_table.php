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
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('NIK')->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['pria', 'wanita']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('agama', ['islam', 'kristen', 'hindhu', 'Budha', 'konghucu','katolik']);
            $table->unsignedBigInteger('id_pendidikan')->nullable();
            $table->unsignedBigInteger('id_pekerjaan');
            $table->unsignedBigInteger('id_status_perkawinan')->nullable();
            $table->unsignedBigInteger('id_rt')->nullable();
            $table->unsignedBigInteger('id_rw')->nullable();
            $table->unsignedBigInteger('id_bantuan')->nullable();
            $table->unsignedBigInteger('id_keluarga')->nullable();
            $table->string('nama_jalan');
            $table->enum('status_penghuni', ['kos', 'kontrak', 'tetap', 'pindah', 'meninggal']);
            $table->date('tanggal_peristiwa')->nullable();
            $table->binary('foto_ktp')->nullable();
            $table->string('no_hp');
            $table->string('email');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk');
    }
};
