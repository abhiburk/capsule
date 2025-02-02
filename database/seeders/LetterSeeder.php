<?php

namespace Database\Seeders;

use App\Models\Letter;
use Illuminate\Database\Seeder;

class LetterSeeder extends Seeder
{
    public function run(): void
    {
        Letter::factory(10)->create();
    }
}
