<?php

namespace Tests\Feature;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServicePageControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test service page is displayed.
     */
    public function test_service_page_is_displayed(): void
    {
        $service = Service::factory()->create([
            'slug' => 'test-service',
            'name' => 'Test Service',
            'is_active' => true,
        ]);

        $response = $this->get('/services/test-service');

        $response->assertStatus(200);
        $response->assertViewIs('services.show');
        $response->assertViewHas('service');
    }

    /**
     * Test service page includes options relationship.
     */
    public function test_service_page_includes_options_relationship(): void
    {
        $service = Service::factory()->create([
            'slug' => 'service-with-options',
            'name' => 'Service With Options',
            'is_active' => true,
        ]);

        $response = $this->get('/services/service-with-options');

        $response->assertStatus(200);
        $service = $response->viewData('service');
        $this->assertNotNull($service);
    }

    /**
     * Test nonexistent service page returns 404.
     */
    public function test_nonexistent_service_page_returns_404(): void
    {
        $response = $this->get('/services/nonexistent-service-slug');

        $response->assertStatus(404);
    }

    /**
     * Test inactive service returns 404.
     */
    public function test_inactive_service_returns_404(): void
    {
        $service = Service::factory()->create([
            'slug' => 'inactive-service',
            'name' => 'Inactive Service',
            'is_active' => false,
        ]);

        $response = $this->get('/services/inactive-service');

        $response->assertStatus(404);
    }
}
