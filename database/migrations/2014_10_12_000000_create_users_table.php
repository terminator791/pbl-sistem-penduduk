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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('NIK_penduduk')->nullable();
            $table->enum('level', ['admin', 'RW', 'RT', 'pemilik_kos']);
            $table->string('password');
            $table->unsignedBigInteger('id_penjabatan_users')->nullable();
            $table->boolean('status_akun')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
