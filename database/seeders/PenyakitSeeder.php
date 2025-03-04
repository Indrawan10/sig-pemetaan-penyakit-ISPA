<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penyakit;

class PenyakitSeeder extends Seeder
{
    public function run(): void
    {
        $penyakitList = ['TBC', 'Batuk', 'Pilek']; // Daftar penyakit awal

        foreach ($penyakitList as $nama) {
            Penyakit::firstOrCreate(['nama' => $nama]);
        }
    }
}
