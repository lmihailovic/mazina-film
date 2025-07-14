<?php

namespace Database\Seeders;

use App\Models\Zanr;
use Illuminate\Database\Seeder;

class ZanrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Zanr::factory()
            ->count(5)
            ->create();
    }
}
