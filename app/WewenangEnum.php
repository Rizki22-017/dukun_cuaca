<?php

namespace App;

enum WewenangEnum: string
{
    case PegawaiBiasa = 'Pegawai biasa';
    case PimpinanSt = 'Pimpinan ST';
    case PimpinanSpd = 'Pimpinan SPD';
    case Admin = 'Admin';

    public function label(): string
    {
        return match($this) {
            self::PegawaiBiasa => 'Pegawai biasa',
            self::PimpinanSt => 'Pimpinan ST',
            self::PimpinanSpd => 'Pimpinan SPD',
            self::Admin => 'Admin',
        };
    }
}
