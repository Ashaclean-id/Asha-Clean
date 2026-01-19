<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'service_id' => Service::factory(),
            'user_id' => null,
            'name' => fake()->name(),
            'phone' => fake()->numerify('08##########'),
            'address' => fake()->address(),
            'booking_date' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'booking_time' => fake()->time('H:i'),
            'notes' => fake()->optional()->sentence(),
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'total_price' => fake()->numberBetween(100000, 500000),
            'snap_token' => null,
        ];
    }

    /**
     * Booking dengan user login.
     */
    public function withUser(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => User::factory(),
        ]);
    }

    /**
     * Booking yang sudah dibayar.
     */
    public function paid(): static
    {
        return $this->state(fn (array $attributes) => [
            'payment_status' => 'paid',
            'status' => 'approved',
        ]);
    }

    /**
     * Booking dengan snap token.
     */
    public function withSnapToken(): static
    {
        return $this->state(fn (array $attributes) => [
            'snap_token' => fake()->uuid(),
        ]);
    }
}
