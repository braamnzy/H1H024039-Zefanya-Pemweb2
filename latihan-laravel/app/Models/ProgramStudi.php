<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramStudi extends Model
{
    protected $table = 'program_studi';
    protected $fillable = ['kode', 'nama', 'jenjang'];
    public function mahasiswa(): HasMany
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function mahasiswas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function matakuliahs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Matakuliah::class);
    }
}
