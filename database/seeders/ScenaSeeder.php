<?php

namespace Database\Seeders;

use App\Models\Scena;
use Illuminate\Database\Seeder;

class ScenaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Scena::factory()
            ->count(5)
            ->create();
    }
}
