<?php

namespace Tests\Feature;

use App\Models\LandingSetting;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ServiceControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /**
     * Test public service page is displayed.
     */
    public function test_public_service_page_is_displayed(): void
    {
        LandingSetting::factory()->create();
        $service = Service::factory()->create([
            'slug' => 'cuci-karpet',
            'is_active' => true,
        ]);

        $response = $this->get('/services/cuci-karpet');

        $response->assertStatus(200);
        $response->assertViewIs('services.show');
        $response->assertViewHas('service');
    }

    /**
     * Test inactive service returns 404.
     */
    public function test_inactive_service_returns_404(): void
    {
        $service = Service::factory()->create([
            'slug' => 'inactive-service',
            'is_active' => false,
        ]);

        $response = $this->get('/services/inactive-service');

        $response->assertStatus(404);
    }

    /**
     * Test admin can view services index.
     */
    public function test_admin_can_view_services_index(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Service::factory()->count(3)->create();

        $response = $this->actingAs($admin)->get('/admin/services');

        $response->assertStatus(200);
        $response->assertViewIs('admin.services.index');
        $response->assertViewHas('services');
    }

    /**
     * Test admin can view create service form.
     */
    public function test_admin_can_view_create_form(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/services/create');

        $response->assertStatus(200);
        $response->assertViewIs('admin.services.create');
    }

    /**
     * Test admin can create a service.
     */
    public function test_admin_can_create_service(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/services', [
            'name' => 'Cuci Sofa Premium',
            'price' => 200000,
            'is_active' => true,
            'show_booking' => true,
            'benefit_1_title' => 'Bersih Maksimal',
            'benefit_1_desc' => 'Menggunakan alat profesional',
            'price_name_1' => 'Sofa 1 Seat',
            'price_value_1' => 100000,
        ]);

        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('services', [
            'name' => 'Cuci Sofa Premium',
            'slug' => 'cuci-sofa-premium',
        ]);
    }

    /**
     * Test service creation requires name.
     */
    public function test_service_creation_requires_name(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/services', [
            'price' => 200000,
        ]);

        $response->assertSessionHasErrors('name');
    }

    /**
     * Test service creation requires price.
     */
    public function test_service_creation_requires_price(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/services', [
            'name' => 'Test Service',
        ]);

        $response->assertSessionHasErrors('price');
    }

    /**
     * Test admin can view edit form.
     */
    public function test_admin_can_view_edit_form(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $service = Service::factory()->create();

        $response = $this->actingAs($admin)->get("/admin/services/{$service->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('admin.services.edit');
        $response->assertViewHas('service');
    }

    /**
     * Test admin can update a service.
     */
    public function test_admin_can_update_service(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $service = Service::factory()->create();

        $response = $this->actingAs($admin)->put("/admin/services/{$service->id}", [
            'name' => 'Updated Service Name',
            'price' => 300000,
        ]);

        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'name' => 'Updated Service Name',
            'price' => 300000,
        ]);
    }

    /**
     * Test admin can upload image when creating service.
     * @requires extension gd
     */
    public function test_admin_can_upload_image(): void
    {
        if (!function_exists('imagecreatetruecolor')) {
            $this->markTestSkipped('GD extension is not installed.');
        }
        
        $admin = User::factory()->create(['role' => 'admin']);
        $image = UploadedFile::fake()->image('service.jpg');

        $response = $this->actingAs($admin)->post('/admin/services', [
            'name' => 'Service With Image',
            'price' => 150000,
            'image' => $image,
        ]);

        $response->assertRedirect(route('admin.services.index'));
        
        $service = Service::where('name', 'Service With Image')->first();
        $this->assertNotNull($service->image);
        Storage::disk('public')->assertExists($service->image);
    }

    /**
     * Test non-admin cannot access admin services.
     */
    public function test_non_admin_cannot_access_admin_services(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/services');

        $response->assertStatus(403);
    }

    /**
     * Test guest cannot access admin services.
     */
    public function test_guest_cannot_access_admin_services(): void
    {
        $response = $this->get('/admin/services');

        $response->assertRedirect('/login');
    }

    /**
     * Test admin can update service with new image.
     * @requires extension gd
     */
    public function test_admin_can_update_service_with_image(): void
    {
        if (!function_exists('imagecreatetruecolor')) {
            $this->markTestSkipped('GD extension is not installed.');
        }

        $admin = User::factory()->create(['role' => 'admin']);
        
        // Create service with existing image
        $oldImage = UploadedFile::fake()->image('old_service.jpg');
        $oldPath = $oldImage->store('services', 'public');
        $service = Service::factory()->create(['image' => $oldPath]);

        // Update with new image
        $newImage = UploadedFile::fake()->image('new_service.jpg');
        $response = $this->actingAs($admin)->put("/admin/services/{$service->id}", [
            'name' => 'Updated Service',
            'price' => 250000,
            'image' => $newImage,
        ]);

        $response->assertRedirect(route('admin.services.index'));
        
        $service->refresh();
        // Old image should be deleted
        Storage::disk('public')->assertMissing($oldPath);
        // New image should exist
        Storage::disk('public')->assertExists($service->image);
    }

    /**
     * Test admin can update service with benefits and pricelist.
     */
    public function test_admin_can_update_service_with_benefits_and_pricelist(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $service = Service::factory()->create();

        $response = $this->actingAs($admin)->put("/admin/services/{$service->id}", [
            'name' => 'Service With Benefits',
            'price' => 300000,
            'benefit_1_title' => 'Benefit One',
            'benefit_1_desc' => 'Description one',
            'benefit_2_title' => 'Benefit Two',
            'benefit_2_desc' => 'Description two',
            'price_name_1' => 'Small Package',
            'price_value_1' => 100000,
            'price_name_2' => 'Large Package',
            'price_value_2' => 200000,
            'is_active' => true,
            'show_booking' => true,
        ]);

        $response->assertRedirect(route('admin.services.index'));
        
        $service->refresh();
        $this->assertEquals('Service With Benefits', $service->name);
        $this->assertCount(2, $service->benefits);
        $this->assertCount(2, $service->pricelist);
    }

    /**
     * Test admin can create service without optional fields.
     */
    public function test_admin_can_create_service_without_optional_fields(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/services', [
            'name' => 'Basic Service',
            'price' => 50000,
        ]);

        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('services', [
            'name' => 'Basic Service',
            'price' => 50000,
            'is_active' => 0,
            'show_booking' => 0,
        ]);
    }

    /**
     * Test admin can create service with all benefits filled.
     */
    public function test_admin_can_create_service_with_all_benefits(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/services', [
            'name' => 'Full Benefits Service',
            'price' => 500000,
            'is_active' => 'on',
            'benefit_1_title' => 'Benefit 1',
            'benefit_1_desc' => 'Description 1',
            'benefit_2_title' => 'Benefit 2',
            'benefit_2_desc' => 'Description 2',
            'benefit_3_title' => 'Benefit 3',
            'benefit_3_desc' => 'Description 3',
            'benefit_4_title' => 'Benefit 4',
            'benefit_4_desc' => 'Description 4',
        ]);

        $response->assertRedirect(route('admin.services.index'));
        
        $service = Service::where('name', 'Full Benefits Service')->first();
        $this->assertCount(4, $service->benefits);
    }

    /**
     * Test admin can create service with multiple pricelist items.
     */
    public function test_admin_can_create_service_with_multiple_pricelist(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/services', [
            'name' => 'Multi Price Service',
            'price' => 100000,
            'price_name_1' => 'Small',
            'price_value_1' => 50000,
            'price_name_2' => 'Medium',
            'price_value_2' => 100000,
            'price_name_3' => 'Large',
            'price_value_3' => 150000,
        ]);

        $response->assertRedirect(route('admin.services.index'));
        
        $service = Service::where('name', 'Multi Price Service')->first();
        $this->assertCount(3, $service->pricelist);
    }

    /**
     * Test editing non-existent service returns 404.
     */
    public function test_editing_nonexistent_service_returns_404(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/services/9999/edit');

        $response->assertStatus(404);
    }

    /**
     * Test updating non-existent service returns 404.
     */
    public function test_updating_nonexistent_service_returns_404(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->put('/admin/services/9999', [
            'name' => 'Updated',
            'price' => 100000,
        ]);

        $response->assertStatus(404);
    }
}
