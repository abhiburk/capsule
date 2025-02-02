<?php

namespace Database\Factories;

use App\Models\Capsule;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LetterFactory extends Factory
{
    public function definition(): array
    {
        $fakerDateTime = $this->faker->dateTimeBetween('-1 year', 'now');
        return [
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'capsule_id' => Capsule::query()->inRandomOrder()->value('id'),
            'title' => "A letter from {$fakerDateTime->format('M d, Y')}",
            'message' => $this->faker->text,
            'channels' => [\App\Enums\ChannelTypesEnum::EMAIL],
            'scheduled_days' => $this->faker->numberBetween(1, 5) * 365,
            'scheduled_at' => $this->faker->dateTimeBetween('now', '+1 year'),
            'delivered_at' => null,
            'read_at' => null,
            'is_public' => $this->faker->boolean,
            'created_at' => $fakerDateTime,
            'updated_at' => $fakerDateTime,
        ];
    }
}
