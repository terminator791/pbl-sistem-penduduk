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
            $table->foreign('id_penjabatan_users')->references('id_penjabatan')->on('penjabatan_rt')->onDelete('set null');
        });

        Schema::table('tabel_rt', function (Blueprint $table) {
            $table->foreign('id_rw')->references('id')->on('tabel_rw')->onDelete('set null');
        });

        Schema::table('penduduk', function (Blueprint $table) {
            $table->foreign('id_pendidikan')->references('id')->on('pendidikan')->onDelete('set null');
            $table->foreign('id_pekerjaan')->references('id')->on('pekerjaan')->onDelete('set null');
            $table->foreign('id_status_perkawinan')->references('id')->on('perkawinan')->onDelete('set null');
            $table->foreign('id_keluarga')->references('id')->on('keluarga')->onDelete('set null');
            $table->foreign('id_rt')->references('id')->on('tabel_rt')->onDelete('set null');
            $table->foreign('id_rw')->references('id_rw')->on('tabel_rt')->onDelete('set null');
            $table->foreign('id_bantuan')->references('id')->on('bantuan')->onDelete('set null');
        });

        Schema::table('detail_pendatang', function (Blueprint $table) { 
            $table->foreign('NIK')->references('NIK')->on('penduduk')->onDelete('cascade');
            $table->foreign('id_kos')->references('id')->on('tabel_kos')->onDelete('cascade');

        });


        Schema::table('penjabatan_rt', function (Blueprint $table) { 
            $table->foreign('NIK_ketua_RT')->references('NIK')->on('penduduk')->onDelete('cascade');
            $table->foreign('id_rt')->references('id')->on('tabel_rt')->onDelete('cascade');
        });

        Schema::table('kejadian', function (Blueprint $table) {
            $table->foreign('NIK_penduduk')->references('NIK')->on('penduduk')->onDelete('cascade');
            $table->foreign('jenis_kejadian')->references('id')->on('jenis_kejadian')->onDelete('cascade');
        });

        Schema::table('tabel_kos', function (Blueprint $table) {
            $table->foreign('id_rt')->references('id')->on('tabel_rt');
        });

        Schema::table('kesehatan', function (Blueprint $table) {
            $table->foreign('NIK_penduduk')->references('NIK')->on('penduduk')->onDelete('cascade');
            $table->foreign('id_penyakit')->references('id')->on('jenis_penyakit')->onDelete('cascade');
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
