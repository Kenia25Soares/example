<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        //\App\Models\Post::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Kenia',
            'last_name' => 'Ss',
            'email' => 'test@example.com',
        ]);

         $this->call(JobSeeder::class);
    }
}
