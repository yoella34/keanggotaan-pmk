<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel dengan menonaktifkan constraint sementara
        Schema::disableForeignKeyConstraints();
        DB::table('mahasiswas')->truncate();
        DB::table('jurusans')->truncate();
        DB::table('fakultas')->truncate();
        Schema::enableForeignKeyConstraints();

        // Jalankan seeder
        $this->call([
            FakultasSeeder::class,
            JurusanSeeder::class,
        ]);
    }
}
