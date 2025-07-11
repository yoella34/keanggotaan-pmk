<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jurusan;
use App\Models\Mahasiswa;

class Fakultas extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function jurusan()
    {
        return $this->hasMany(Jurusan::class);
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
