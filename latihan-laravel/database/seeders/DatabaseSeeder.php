<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProgramStudiSeeder::class,
            MatakuliahSeeder::class,
        ]);

        Mahasiswa::factory()->count(30)->create();

        $matakuliahIds = MataKuliah::pluck('id')->toArray();
        $daftarNilai  = ['A', 'B+', 'B', 'C+', 'C', 'D', 'E'];

        Mahasiswa::all()->each(function ($mahasiswa) use ($matakuliahIds, $daftarNilai) {
            $randomMk = (array) array_rand(array_flip($matakuliahIds), 2);
            
            foreach ($randomMk as $mkId) {
                $mahasiswa->matakuliahs()->attach($mkId, [
                    'nilai' => $daftarNilai[array_rand($daftarNilai)]
                ]);
            }
        });
    }
}
