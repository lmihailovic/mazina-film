<?php

namespace Database\Seeders;

use App\Models\Scena;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScenaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('scenas')->insert([
            [
                'ScenaID' => 1,
                'film_id' => 1,
                'Lokacija' => 'Selo u Teksasu',
                'DatumSnimanja' => '2025-10-01',
            ],
            [
                'ScenaID' => 2,
                'film_id' => 1,
                'Lokacija' => 'Grad Meksiko',
                'DatumSnimanja' => '2025-10-15',
            ],
            [
                'ScenaID' => 3,
                'film_id' => 2,
                'Lokacija' => 'Teatar u Beogradu',
                'DatumSnimanja' => '2026-02-01',
            ],
        ]);
    }
}
