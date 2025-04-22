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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->foreignId('id_pejabat')
                ->constrained('pegawais', 'id_pegawai')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->text('tugas');
            $table->json('kendaraan')->nullable();
            $table->string('lokasi_berangkat');
            $table->string('lokasi_tujuan');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->foreignId('id_pegawai_bertugas')
                ->constrained('pegawais', 'id_pegawai')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->json('pengikut')->nullable();
            $table->string('sumber_dana');
            $table->string('akun');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
