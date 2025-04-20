<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PimpinanSpd extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pimpinan_spd';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_pegawai'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }
}
