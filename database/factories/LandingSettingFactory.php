<?php

namespace Database\Factories;

use App\Models\LandingSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LandingSetting>
 */
class LandingSettingFactory extends Factory
{
    protected $model = LandingSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hero_title' => 'Layanan Kebersihan Profesional',
            'hero_description' => fake()->sentence(),
            'promo_1_text' => fake()->optional()->sentence(),
            'promo_1_image' => null,
            'promo_2_text' => fake()->optional()->sentence(),
            'promo_2_image' => null,
            'promo_3_text' => fake()->optional()->sentence(),
            'promo_3_image' => null,
            'show_ulasan' => true,
            'show_quick_support' => false,
            'whatsapp_number' => fake()->optional()->numerify('08##########'),
            'show_promotions' => false,
        ];
    }
}
