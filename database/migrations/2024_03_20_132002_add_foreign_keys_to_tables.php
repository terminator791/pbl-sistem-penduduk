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
            $table->foreign('NIK_penduduk')->references('NIK')->on('penduduk');
        });

        Schema::table('rt', function (Blueprint $table) {
            $table->foreign('id_rw')->references('id')->on('rw');
        });

        Schema::table('penduduk', function (Blueprint $table) {
            $table->foreign('id_pendidikan')->references('id')->on('pendidikan');
            $table->foreign('id_pekerjaan')->references('id')->on('pekerjaan');
            $table->foreign('id_status_perkawinan')->references('id')->on('perkawinan');
            $table->foreign('id_keluarga')->references('id')->on('keluarga');
            $table->foreign('id_rt')->references('id')->on('rt');
            $table->foreign('id_rw')->references('id_rw')->on('rt');
            $table->foreign('id_bantuan')->references('id')->on('bantuan');
        });

        Schema::table('detail_pendatang', function (Blueprint $table) { 
            $table->foreign('NIK')->references('NIK')->on('penduduk');
            $table->foreign('id_kos')->references('id')->on('kos');
        });


        Schema::table('penjabatan_rt', function (Blueprint $table) { 
            $table->foreign('NIK_ketua_RT')->references('NIK')->on('penduduk');
            $table->foreign('id_rt')->references('id')->on('rt');
        });

        Schema::table('kejadian', function (Blueprint $table) {
            $table->foreign('NIK_penduduk')->references('NIK')->on('penduduk');
            $table->foreign('jenis_kejadian')->references('id')->on('jenis_kejadian');
        });

        Schema::table('kos', function (Blueprint $table) {
            $table->foreign('id_rt')->references('id')->on('rt');
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
