<?php

namespace Database\Seeders;

use App\Models\PimpinanSt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PimpinanStSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pimpinansts = [
            [
                'id_pegawai' => '9',
            ]
        ];

        foreach ($pimpinansts as $pimpinanst){
            PimpinanSt::create($pimpinanst);
        }
    }
}
