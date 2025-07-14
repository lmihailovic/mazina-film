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
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);

        $this->call(FilmSeeder::class);
        $this->call(ScenaSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ZanrSeeder::class);
        $this->call(ZaposleniSeeder::class);
    }
}
