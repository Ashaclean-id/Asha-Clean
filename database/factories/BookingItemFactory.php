<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\BookingItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookingItem>
 */
class BookingItemFactory extends Factory
{
    protected $model = BookingItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'item_name' => fake()->words(3, true),
            'price' => fake()->numberBetween(50000, 200000),
        ];
    }
}
