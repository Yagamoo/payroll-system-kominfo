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
        Schema::create('presensis', function (Blueprint $table) {
            $table->id('id_presensi')->primary();
            $table->unsignedBigInteger('id_pegawai');
            $table->date('tanggal');
            $table->enum('status_hadir', allowed: ['hadir', 'alpa']);
            $table->time('jam_masuk')->nullable()->comment('null jika alpa');
            $table->time('jam_keluar')->nullable()->comment('null jika alpa');
            $table->time('jam_masuk_normal')->default('09:00:00')->comment('default 09:00:00');
            $table->time('jam_keluar_normal')->default('17:00:00')->comment('default 17:00:00');
            $table->integer('terlambat_menit');
            $table->integer('lembur_menit');

            $table->foreign('id_pegawai')
                ->references('id_pegawai')
                ->on('pegawais')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
