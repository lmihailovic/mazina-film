<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'remember_token' => Str::random(10),
                'role' => 'admin',
            ],
            [
                'name' => 'Stefan Markovic',
                'email' => 'smarkovic@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('test123'),
                'remember_token' => Str::random(10),
                'role' => 'rukovodilac',
            ],
            [
                'name' => 'Filip Fake',
                'email' => 'filip@fake.com',
                'email_verified_at' => now(),
                'password' => Hash::make('lozinka'),
                'remember_token' => Str::random(10),
                'role' => 'zaposleni',
            ],
        ]);
    }
}
