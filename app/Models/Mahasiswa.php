<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Fakultas; // ✅ Tambahkan ini
use App\Models\Jurusan;

class Mahasiswa extends Model
{
    use HasFactory;

   protected $fillable = [
    'nama',
    'nim',
    'email',
    'jurusan_id',
    'fakultas_id',
];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}

