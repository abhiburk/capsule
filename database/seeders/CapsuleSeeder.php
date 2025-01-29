<?php

namespace Database\Seeders;

use App\Models\Letter;
use Illuminate\Database\Seeder;

class CapsuleSeeder extends Seeder
{
    public function run(): void
    {
        Letter::truncate();
        Letter::factory(6)->create();
    }
}
