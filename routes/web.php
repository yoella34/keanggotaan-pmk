<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

// Redirect root ke halaman mahasiswa
Route::get('/', function () {
    return redirect()->route('mahasiswa.index');
});

// Route resource untuk mahasiswa (CRUD)
Route::resource('mahasiswa', MahasiswaController::class);

// Route AJAX untuk update jurusan/fakultas langsung di tabel
Route::post('/mahasiswa/update-field', [MahasiswaController::class, 'updateField'])->name('mahasiswa.updateField');

// Route AJAX untuk ambil jurusan berdasarkan fakultas
Route::get('/get-jurusan/{fakultas_id}', [MahasiswaController::class, 'getJurusan'])->name('get-jurusan');