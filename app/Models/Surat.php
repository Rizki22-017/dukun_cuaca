<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $table = 'surats';

    protected $fillable = [
        'nomor_surat',
        'id_pejabat',
        'tugas',
        'kendaraan',
        'lokasi_berangkat',
        'lokasi_tujuan',
        'tgl_mulai',
        'tgl_selesai',
        'id_pegawai_bertugas',
        'pengikut',
        'sumber_dana',
        'akun',
        'keterangan'
    ];

    protected $casts = [
        'kendaraan' => 'array',
        'pengikut' => 'array',
    ];

    public function pejabat(){
        return $this->belongsTo(Pegawai::class, 'id_pejabat', 'id_pegawai');
    }

    public function pegawaiBertugas(){
        return $this->belongsTo(Pegawai::class, 'id_pegawai_bertugas', 'id_pegawai');
    }

    public function pengikutPegawai()
    {
        return $this->belongsToMany(Pegawai::class, 'pegawais', 'id_pegawai', 'pengikut');
    }
}
