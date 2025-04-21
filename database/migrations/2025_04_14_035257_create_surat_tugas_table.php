<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('surat_tugases', function (Blueprint $table) {
            $table->string('nomor_st', 25)->primary();
            // $table->foreignId('id_pimpinan_st')->constrained('pimpinan_st')->onDelete('cascade');
            // $table->foreignId('id_pegawai')->constrained('pegawais')->onDelete('cascade');
            $table->foreignId('id_pegawai')
                ->constrained('pegawais', 'id_pegawai')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->text('tugas');
            $table->string('selama', 20);
            $table->string('lokasi', 255);
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('sumber_dana', 255);
            $table->date('tgl_pembuatan_st');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_tugas');
    }
};
