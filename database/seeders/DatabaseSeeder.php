<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Enums\Role;
use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        UserFactory::times(1)->create([
            'email' => 'teacher@gmail.com',
            'role' => Role::Teacher
        ]);
        UserFactory::times(1)->create([
            'email' => 'student@gmail.com',
        ]);
        UserFactory::times(30)->create();
    }
}
