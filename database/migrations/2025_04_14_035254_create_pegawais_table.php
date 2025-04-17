<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id('id_pegawai');
            $table->string('nama_pegawai', 50);
            $table->string('nip', 15)->unique();
            $table->string('pangkat_golongan', 50);
            $table->string('jabatan', 15);
            $table->string('bagian_kerja', 50);
            $table->string('tanggal_lahir', 15); // Bisa diubah ke date kalau memungkinkan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
