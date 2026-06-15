<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            BlogSeeder::class,
        ]);

        User::firstOrCreate(
            ['email' => 'admin@jobyaari.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@jobyaari.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );
    }
}
