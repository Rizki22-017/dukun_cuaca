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
        // Tabel Pegawai
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('id_pegawai');
            $table->string('nama_pegawai', 100);
            $table->string('nip', 50)->unique();
            $table->string('pangkat_golongan', 50)->nullable();
            $table->string('jabatan', 100)->nullable();
            $table->string('bagian_kerja', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
        });

        // Tabel Pimpinan ST
        Schema::create('pimpinan_st', function (Blueprint $table) {
            $table->id('id_pimpinan_st');
            $table->foreignId('id_pegawai')->constrained('pegawai');
        });

        // Tabel Pimpinan SPD
        Schema::create('pimpinan_spd', function (Blueprint $table) {
            $table->id('id_pimpinan_spd');
            $table->foreignId('id_pegawai')->constrained('pegawai');
        });

        // Tabel Surat Tugas
        Schema::create('surat_tugas', function (Blueprint $table) {
            $table->id('nomor_st');
            $table->foreignId('id_pimpinan_st')->constrained('pimpinan_st');
            $table->foreignId('id_pegawai')->constrained('pegawai');
            $table->text('tugas');
            $table->integer('selama');
            $table->string('lokasi', 255);
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('sumber_dana', 100)->nullable();
            $table->date('tgl_pembuatan_st');
        });

        // Tabel Surat Perjalanan Dinas
        Schema::create('surat_perjalanan_dinas', function (Blueprint $table) {
            $table->id('nomor_spd');
            $table->foreignId('nomor_st')->constrained('surat_tugas')->onDelete('cascade');
            $table->foreignId('id_pimpinan_spd')->nullable()->constrained('pimpinan_spd')->onDelete('set null');
            $table->date('tgl_spd');
        });

        // Tabel User
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama_lengkap', 100); // dari tabel user milikmu
            $table->string('username', 50)->unique(); // dari tabel user milikmu
            $table->string('email')->unique(); // dari Laravel
            $table->timestamp('email_verified_at')->nullable(); // dari Laravel
            $table->string('password', 255); // digunakan oleh Laravel dan milikmu
            $table->enum('level', ['admin', 'pegawai', 'pimpinan']); // dari tabel user milikmu
            $table->rememberToken(); // dari Laravel
            $table->timestamps(); // created_at & updated_at
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
        Schema::dropIfExists('surat_perjalanan_dinas');
        Schema::dropIfExists('surat_tugas');
        Schema::dropIfExists('pimpinan_spd');
        Schema::dropIfExists('pimpinan_st');
        Schema::dropIfExists('pegawai');
    }
};
