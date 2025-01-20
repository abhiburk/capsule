<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = [
            'name' => 'Abhishek Burkule',
            'email' => 'abhiburk@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password@123'),
            'remember_token' => Str::random(10),
        ];
        User::create($admin);

        // User::factory(10)->create();
        // (new MessageSeeder())->run();
    }
}
