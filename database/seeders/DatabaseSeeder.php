<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Pin;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'User Example',
            'email' => 'user1@example.com',
            'password' => bcrypt('secret')
        ]);

        User::factory()
            ->hasPins(2)
            ->create();
    }
}
