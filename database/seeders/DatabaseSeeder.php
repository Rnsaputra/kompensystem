<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Configuration;
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
        // User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            // ConfigurationSeeder::class, (jika ada seeder lain)
        ]);
        Configuration::create([
            'key' => 'pengali_kompen',
            'value' => '2' // Default 1 Alpha = 2 Jam
        ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
