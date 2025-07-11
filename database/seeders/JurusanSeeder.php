<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;
use App\Models\Fakultas;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $fakultas = Fakultas::all()->keyBy('nama');

        $jurusanData = [
            'Fakultas Ilmu Komputer' => ['Sistem Informasi', 'Informatika', 'Sistem Komputer'],
            'Fakultas Ekonomi dan Bisnis' => ['Manajemen', 'Akuntansi'],
            'Fakultas Teknik' => ['Teknik Mesin', 'Teknik Elektro'],
        ];

        foreach ($jurusanData as $namaFakultas => $jurusans) {
            $fakultasId = $fakultas[$namaFakultas]->id ?? null;

            if ($fakultasId) {
                foreach ($jurusans as $namaJurusan) {
                    Jurusan::create([
                        'nama_jurusan' => $namaJurusan,
                        'fakultas_id' => $fakultasId,
                    ]);
                }
            }
        }
    }
}
