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
        Schema::table('users', function (Blueprint $table) {
            // $table->foreign('NIK_penduduk')->references('NIK')->on('penduduk');
        });

        Schema::table('tabel_rt', function (Blueprint $table) {
            $table->foreign('id_rw')->references('id')->on('tabel_rw');
        });

        Schema::table('penduduk', function (Blueprint $table) {
            $table->foreign('id_pendidikan')->references('id')->on('pendidikan');
            $table->foreign('id_pekerjaan')->references('id')->on('pekerjaan');
            $table->foreign('id_status_perkawinan')->references('id')->on('perkawinan');
            $table->foreign('id_keluarga')->references('id')->on('keluarga');
            $table->foreign('id_rt')->references('id')->on('tabel_rt');
            $table->foreign('id_rw')->references('id_rw')->on('tabel_rt');
            $table->foreign('id_bantuan')->references('id')->on('bantuan');
        });

        Schema::table('detail_pendatang', function (Blueprint $table) { 
            $table->foreign('NIK')->references('NIK')->on('penduduk');
            $table->foreign('id_kos')->references('id')->on('tabel_kos');
            $table->foreign('id_kamar')->references('id')->on('kamar_kos');
        });


        Schema::table('penjabatan_rt', function (Blueprint $table) { 
            $table->foreign('NIK_ketua_RT')->references('NIK')->on('penduduk');
            $table->foreign('id_rt')->references('id')->on('tabel_rt');
        });

        Schema::table('kejadian', function (Blueprint $table) {
            $table->foreign('NIK_penduduk')->references('NIK')->on('penduduk');
            $table->foreign('jenis_kejadian')->references('id')->on('jenis_kejadian');
        });

        Schema::table('tabel_kos', function (Blueprint $table) {
            $table->foreign('id_rt')->references('id')->on('tabel_rt');
        });

        Schema::table('kesehatan', function (Blueprint $table) {
            $table->foreign('NIK_penduduk')->references('NIK')->on('penduduk');
            $table->foreign('id_penyakit')->references('id')->on('jenis_penyakit');
        });
        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
};
