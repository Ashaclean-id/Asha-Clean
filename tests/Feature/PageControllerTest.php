<?php

namespace Tests\Feature;

use App\Models\LandingSetting;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test landing page is displayed.
     */
    public function test_landing_page_is_displayed(): void
    {
        LandingSetting::factory()->create();

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test landing page shows active services.
     */
    public function test_landing_page_shows_active_services(): void
    {
        LandingSetting::factory()->create();
        Service::factory()->count(3)->create(['is_active' => true]);
        Service::factory()->create(['is_active' => false]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test landing page shows approved reviews.
     */
    public function test_landing_page_shows_approved_reviews(): void
    {
        LandingSetting::factory()->create();
        Review::factory()->count(3)->create(['status' => 'approved']);
        Review::factory()->create(['status' => 'pending']);

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test services listing page is displayed.
     */
    public function test_services_page_is_displayed(): void
    {
        LandingSetting::factory()->create();
        Service::factory()->count(5)->create(['is_active' => true]);

        $response = $this->get('/services');

        $response->assertStatus(200);
    }

    /**
     * Test services page only shows active services.
     */
    public function test_services_page_only_shows_active_services(): void
    {
        LandingSetting::factory()->create();
        Service::factory()->count(3)->create(['is_active' => true]);
        Service::factory()->count(2)->create(['is_active' => false]);

        $response = $this->get('/services');

        $response->assertStatus(200);
    }
}
