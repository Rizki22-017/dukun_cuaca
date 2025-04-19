<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pegawai';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_pegawai',
        'nip',
        'pangkat_golongan',
        'jabatan',
        'bagian_kerja',
        'tanggal_lahir',
    ];
}
