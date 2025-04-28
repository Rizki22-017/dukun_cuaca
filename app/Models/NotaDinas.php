<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotaDinas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_surat',
        'filename'
    ];

    public function surats()
    {
        return $this->hasMany(Surat::class, 'id_nota_dinas');
    }

    public function lpds()
    {
        return $this->hasMany(LaporanPerjalananDinas::class, 'id_nota_dinas');
    }

}
