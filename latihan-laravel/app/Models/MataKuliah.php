<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MataKuliah extends Model
{
    protected $table = 'matakuliah';
    protected $fillable = [
        'kode',
        'nama',
        'sks',
        'semester',
    ];
    public function mahasiswas(): BelongsToMany
    {
        return $this->belongsToMany(
            Mahasiswa::class,
            'mahasiswa_matakuliah', // Nama tabel pivot
            'matakuliah_id',        // Foreign key untuk Matakuliah
            'mahasiswa_id'          // Foreign key untuk Mahasiswa
        )
            ->withPivot('nilai')
            ->withTimestamps();
    }
}
