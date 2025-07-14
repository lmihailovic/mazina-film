<?php

namespace Database\Seeders;

use App\Models\Zanr;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZanrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('zanrs')->insert([
            ['ZanrID' => 1, 'Naziv' => 'Western'],
            ['ZanrID' => 2, 'Naziv' => 'Drama'],
            ['ZanrID' => 3, 'Naziv' => 'Komedija'],
            ['ZanrID' => 4, 'Naziv' => 'Akcija'],
            ['ZanrID' => 5, 'Naziv' => 'Triler'],
        ]);
    }
}
