<?php

namespace Database\Seeders;

use App\Models\Zaposleni;
use Illuminate\Database\Seeder;

class ZaposleniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Zaposleni::factory()
            ->count(5)
            ->create();
    }
}
