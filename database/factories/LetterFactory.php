<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LetterFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'capsule_id' => \App\Models\Capsule::factory(),
            'message' => $this->faker->text,
            'channels' => [\App\Enums\ChannelTypesEnum::EMAIL],
            'scheduled_days' => $this->faker->numberBetween(1, 5) * 365,
            'scheduled_at' => $this->faker->dateTimeBetween('now', '+1 year'),
            'delivered_at' => null,
            'read_at' => null,
            'is_public' => $this->faker->boolean,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
