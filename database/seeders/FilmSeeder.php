<?php

namespace Database\Seeders;

use App\Models\Film;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('films')->insert([
            [
                'FilmID' => 1,
                'zanr_ID' => 1,
                'Naziv' => 'Za dolar više',
                'Status' => 'predprodukcija',
                'Budzet' => 15000.00,
                'DatumIzlaska' => '2025-12-31',
            ],
            [
                'FilmID' => 2,
                'zanr_ID' => 2,
                'Naziv' => 'Erin Brokovic',
                'Status' => 'produkcija',
                'Budzet' => 35000.00,
                'DatumIzlaska' => '2026-06-15',
            ],
        ]);
    }
}
