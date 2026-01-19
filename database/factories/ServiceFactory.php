<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(3, true);
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'price' => fake()->numberBetween(50000, 500000),
            'short_description' => fake()->sentence(),
            'full_description' => fake()->paragraph(),
            'duration' => fake()->optional()->randomElement(['1 jam', '2 jam', '3 jam']),
            'team_size' => fake()->optional()->numberBetween(1, 5),
            'image' => null,
            'benefits' => [
                ['title' => 'Benefit 1', 'desc' => fake()->sentence()],
                ['title' => 'Benefit 2', 'desc' => fake()->sentence()],
            ],
            'pricelist' => [
                ['name' => 'Paket Basic', 'price' => fake()->numberBetween(50000, 100000)],
                ['name' => 'Paket Premium', 'price' => fake()->numberBetween(100000, 200000)],
            ],
            'is_active' => true,
            'show_booking' => true,
            'booking_label' => null,
        ];
    }

    /**
     * Indicate that the service is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Indicate that booking is hidden.
     */
    public function hideBooking(): static
    {
        return $this->state(fn (array $attributes) => [
            'show_booking' => false,
        ]);
    }
}
