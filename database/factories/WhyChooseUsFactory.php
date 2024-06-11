<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WhyChooseUs>
 */
class WhyChooseUsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'icon' => fake()->randomElement(['fas fa-tachometer-alt-fastest', 'fas fa-comments-alt', 'fad fa-comments-dollar']),
            'title' => fake()->sentence(),
            'short_description' => fake()->sentence(),
            'status' => fake()->boolean()
        ];
    }
}
