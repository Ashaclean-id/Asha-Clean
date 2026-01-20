<?php

namespace Tests\Feature;

use App\Models\ServicePage;
use App\Models\ServiceTool;
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
        $servicePage = ServicePage::factory()->create([
            'slug' => 'test-service',
            'title' => 'Test Service',
        ]);

        $response = $this->get('/layanan/test-service');

        $response->assertStatus(200);
        $response->assertViewIs('services.show');
        $response->assertViewHas('service');
    }

    /**
     * Test service page includes tools relationship.
     */
    public function test_service_page_includes_tools_relationship(): void
    {
        $servicePage = ServicePage::factory()->create([
            'slug' => 'service-with-tools',
            'title' => 'Service With Tools',
        ]);

        ServiceTool::create([
            'service_page_id' => $servicePage->id,
            'name' => 'Tool 1',
            'description' => 'Tool 1 Description',
            'icon' => 'icon-1',
        ]);

        ServiceTool::create([
            'service_page_id' => $servicePage->id,
            'name' => 'Tool 2',
            'description' => 'Tool 2 Description',
            'icon' => 'icon-2',
        ]);

        $response = $this->get('/layanan/service-with-tools');

        $response->assertStatus(200);
        $service = $response->viewData('service');
        $this->assertTrue($service->relationLoaded('tools'));
        $this->assertCount(2, $service->tools);
    }

    /**
     * Test nonexistent service page returns 404.
     */
    public function test_nonexistent_service_page_returns_404(): void
    {
        $response = $this->get('/layanan/nonexistent-service-slug');

        $response->assertStatus(404);
    }

    /**
     * Test service page with no tools still loads.
     */
    public function test_service_page_with_no_tools_still_loads(): void
    {
        $servicePage = ServicePage::factory()->create([
            'slug' => 'service-no-tools',
            'title' => 'Service No Tools',
        ]);

        $response = $this->get('/layanan/service-no-tools');

        $response->assertStatus(200);
        $service = $response->viewData('service');
        $this->assertCount(0, $service->tools);
    }
}
