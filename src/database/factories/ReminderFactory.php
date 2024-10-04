<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reminder>
 */
class ReminderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->numberBetween(1, 1000),
            'title' => fake()->title,
            'description' => fake()->sentence,
            'remind_at' => now()->timestamp,
            'event_at' => now()->addHour()->timestamp,
        ];
    }
}
