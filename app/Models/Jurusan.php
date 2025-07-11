<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Fakultas;
use App\Models\Mahasiswa;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_jurusan', 'fakultas_id'];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
