<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPerjalananDinas extends Model
{
    use HasFactory;
    protected $table = 'lpds';

    protected $fillable = [
        'id_nota_dinas',
        'filename',
    ];

    public function notaDinas()
    {
        return $this->belongsTo(NotaDinas::class, 'id_nota_dinas');
    }
}
