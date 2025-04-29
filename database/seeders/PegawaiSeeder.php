<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pegawais = [
            [
                'nama_pegawai' => 'Rizki',
                'nip' => '123456789012345678',
                'pangkat_golongan' => 'iii',
                'jabatan' => 'pegawai',
                'bagian_kerja' => 'ahli',
                'tanggal_lahir' => '2001-01-01',

            ]
        ];

        foreach ($pegawais as $pegawai) {
            Pegawai::create($pegawai);
        }
    }
}
