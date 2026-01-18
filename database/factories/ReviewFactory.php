<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'rating' => fake()->numberBetween(1, 5),
            'content' => fake()->paragraph(),
            'service_id' => Service::factory(),
            'status' => 'approved',
        ];
    }

    /**
     * Review dengan status pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Review dengan status hidden.
     */
    public function hidden(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'hidden',
        ]);
    }

    /**
     * Review tanpa service (general review).
     */
    public function withoutService(): static
    {
        return $this->state(fn (array $attributes) => [
            'service_id' => null,
        ]);
    }
}
