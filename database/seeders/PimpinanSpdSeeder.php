<?php

namespace Database\Seeders;

use App\Models\PimpinanSpd;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PimpinanSpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pimpinanspds = [
            [
                'id_pegawai' => '10',
            ]
        ];

        foreach ($pimpinanspds as $pimpinanspd){
            PimpinanSpd::create($pimpinanspd);
        }
    }
}
