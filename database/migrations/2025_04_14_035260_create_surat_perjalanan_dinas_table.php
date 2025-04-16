<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('spds', function (Blueprint $table) {
            $table->id('nomor_spd');
            $table->string('nomor_st', 25);
            $table->foreign('nomor_st')->references('nomor_st')->on('surat_tugas')->onDelete('cascade');
            $table->foreignId('id_pimpinan_spd')->constrained('pimpinan_spd')->onDelete('cascade');
            $table->date('tgl_spd');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spds');
    }
};
