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
}
