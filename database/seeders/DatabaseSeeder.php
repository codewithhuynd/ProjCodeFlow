<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // tạo user test
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // chạy các seeder khác
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            AdminUserSeeder::class,
        ]);

    }
}