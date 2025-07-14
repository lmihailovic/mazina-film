<?php

namespace Database\Seeders;

use App\Models\Zaposleni;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZaposleniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('zaposlenis')->insert([
            [
                'ZaposleniID' => 1,
                'Ime' => 'Marko',
                'Prezime' => 'Markovic',
                'Uloga' => 'Glumac',
                'Status' => 'aktivan',
            ],
            [
                'ZaposleniID' => 2,
                'Ime' => 'Jelena',
                'Prezime' => 'Jovic',
                'Uloga' => 'Tonac',
                'Status' => 'aktivan',
            ],
            [
                'ZaposleniID' => 3,
                'Ime' => 'Nikola',
                'Prezime' => 'Petrovic',
                'Uloga' => 'Gafer',
                'Status' => 'odsutan',
            ],
        ]);
    }
}
