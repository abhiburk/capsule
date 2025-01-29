<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CapsuleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'title' => rtrim($this->faker->sentence(2), '.'),
            'description' => $this->faker->text,
            'visibility' => $this->faker->boolean,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
