<?php

namespace Database\Seeders;

use App\Models\Capsule;
use Illuminate\Database\Seeder;

class CapsuleSeeder extends Seeder
{
    public function run(): void
    {
        Capsule::factory(6)->create();
    }
}
