<?php

namespace Tests\Unit\Models;

use App\Models\Service;
use App\Models\ServiceOption;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test auto slug generation when creating a service.
     */
    public function test_auto_generates_slug_on_creation(): void
    {
        $service = Service::create([
            'name' => 'Cuci Karpet Premium',
            'price' => 150000,
            'is_active' => true,
            'show_booking' => true,
        ]);

        $this->assertEquals('cuci-karpet-premium', $service->slug);
    }

    /**
     * Test slug is not overwritten if already provided.
     */
    public function test_does_not_overwrite_existing_slug(): void
    {
        $service = Service::create([
            'name' => 'Cuci Karpet Premium',
            'slug' => 'custom-slug',
            'price' => 150000,
            'is_active' => true,
            'show_booking' => true,
        ]);

        $this->assertEquals('custom-slug', $service->slug);
    }

    /**
     * Test benefits attribute is cast to array.
     */
    public function test_benefits_is_cast_to_array(): void
    {
        $benefits = [
            ['title' => 'Benefit 1', 'desc' => 'Description 1'],
            ['title' => 'Benefit 2', 'desc' => 'Description 2'],
        ];

        $service = Service::factory()->create([
            'benefits' => $benefits,
        ]);

        $service->refresh();

        $this->assertIsArray($service->benefits);
        $this->assertCount(2, $service->benefits);
        $this->assertEquals('Benefit 1', $service->benefits[0]['title']);
    }

    /**
     * Test pricelist attribute is cast to array.
     */
    public function test_pricelist_is_cast_to_array(): void
    {
        $pricelist = [
            ['name' => 'Paket Basic', 'price' => 100000],
            ['name' => 'Paket Premium', 'price' => 200000],
        ];

        $service = Service::factory()->create([
            'pricelist' => $pricelist,
        ]);

        $service->refresh();

        $this->assertIsArray($service->pricelist);
        $this->assertCount(2, $service->pricelist);
        $this->assertEquals('Paket Basic', $service->pricelist[0]['name']);
    }

    /**
     * Test is_active attribute is cast to boolean.
     */
    public function test_is_active_is_cast_to_boolean(): void
    {
        $service = Service::factory()->create(['is_active' => 1]);
        $service->refresh();

        $this->assertIsBool($service->is_active);
        $this->assertTrue($service->is_active);
    }

    /**
     * Test show_booking attribute is cast to boolean.
     */
    public function test_show_booking_is_cast_to_boolean(): void
    {
        $service = Service::factory()->create(['show_booking' => 0]);
        $service->refresh();

        $this->assertIsBool($service->show_booking);
        $this->assertFalse($service->show_booking);
    }

    /**
     * Test options relationship.
     */
    public function test_has_many_options_relationship(): void
    {
        $service = Service::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $service->options());
    }

    /**
     * Test factory creates valid service.
     */
    public function test_factory_creates_valid_service(): void
    {
        $service = Service::factory()->create();

        $this->assertNotNull($service->id);
        $this->assertNotNull($service->name);
        $this->assertNotNull($service->slug);
        $this->assertNotNull($service->price);
        $this->assertTrue($service->is_active);
    }

    /**
     * Test inactive state in factory.
     */
    public function test_factory_inactive_state(): void
    {
        $service = Service::factory()->inactive()->create();

        $this->assertFalse($service->is_active);
    }
}
