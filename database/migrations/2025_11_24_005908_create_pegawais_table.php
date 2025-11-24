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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id('id_pegawai')->primary();
            $table->string('nama', 150)->comment('Nama Lengkap');
            $table->string('gelar', 20)->comment('Gelar pendidikan (SMA/D3/S1/S2)');
            $table->unsignedBigInteger('id_jabatan');

            $table->foreign('id_jabatan')
                ->references('id_jabatan')
                ->on('jabatans')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
