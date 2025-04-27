<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $table = 'surats';

    protected $fillable = [
        'id_nota_dinas',
        'id_pejabat_st',
        'id_pejabat_spd',
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

    public function pejabatSt(){
        return $this->belongsTo(Pegawai::class, 'id_pejabat_st', 'id_pegawai');
    }

    public function pejabatSpd(){
        return $this->belongsTo(Pegawai::class, 'id_pejabat_spd', 'id_pegawai');
    }


    public function pegawaiBertugas(){
        return $this->belongsTo(Pegawai::class, 'id_pegawai_bertugas', 'id_pegawai');
    }

    public function notaDinas()
    {
        return $this->belongsTo(NotaDinas::class, 'id_nota_dinas');
    }
}
