<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matakuliahs = [
            ['kode' => 'TK101', 'nama' => 'Pemrograman Web II', 'sks' => 3, 'semester' => 4],
            ['kode' => 'TK102', 'nama' => 'Sistem Tertanam', 'sks' => 3, 'semester' => 4],
            ['kode' => 'TK103', 'nama' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 3],
            ['kode' => 'TK104', 'nama' => 'Struktur Data', 'sks' => 3, 'semester' => 2],
        ];

        foreach ($matakuliahs as $mk) {
            Matakuliah::create($mk);
        }
    }
}
