<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fakultas;

class FakultasSeeder extends Seeder
{
    public function run(): void
    {
        $fakultas = [
            'Fakultas Ilmu Komputer',
            'Fakultas Ekonomi dan Bisnis',
            'Fakultas Teknik',
        ];

        foreach ($fakultas as $nama) {
            Fakultas::create(['nama' => $nama]);
        }
    }
}
