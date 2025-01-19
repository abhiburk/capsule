<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'content' => $this->faker->text,
            'channels' => [\App\Enums\ChannelTypesEnum::EMAIL],
            'delivery_days' => $this->faker->numberBetween(1, 5) * 365,
            'scheduled_at' => $this->faker->dateTimeBetween('now', '+1 year'),
            'delivered_at' => null,
            'read_at' => null,
            'is_public' => false,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
