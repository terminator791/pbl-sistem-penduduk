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
        Schema::create('kesehatan', function (Blueprint $table) {
            $table->id();
            $table->string('NIK_penduduk');
            $table->date('tanggal_terdampak')->nullable();
            $table->unsignedBigInteger('id_penyakit');
            $table->enum('status', ['sakit', 'sembuh', 'meninggal'])->default('sakit');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('kesehatan');
    }
};
