<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ZanrSeeder::class,
            FilmSeeder::class,
            ScenaSeeder::class,
            ZaposleniSeeder::class,
            UserSeeder::class,
        ]);
    }
}
