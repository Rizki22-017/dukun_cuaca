<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pimpinan_spd', function (Blueprint $table) {
            $table->id('id_pimpinan_spd');
            $table->foreignId('id_pegawai')->constrained('pegawais')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pimpinan_spd');
    }
};
