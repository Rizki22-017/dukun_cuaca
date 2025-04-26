<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('nota_dinas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('filename');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nota_dinas');
    }
};
