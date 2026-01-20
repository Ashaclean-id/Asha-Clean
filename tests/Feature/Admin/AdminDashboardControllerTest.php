<?php

namespace Tests\Feature\Admin;

use App\Models\Booking;
use App\Models\LandingSetting;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminDashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test admin can view dashboard.
     */
    public function test_admin_can_view_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        LandingSetting::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }

    /**
     * Test dashboard shows correct view data.
     */
    public function test_dashboard_shows_correct_view_data(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        LandingSetting::factory()->create();
        
        // Create services
        Service::factory()->count(3)->create();
        
        // Create bookings
        Booking::factory()->count(5)->create();

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('setting');
        $response->assertViewHas('totalPendapatan');
        $response->assertViewHas('totalBooking');
        $response->assertViewHas('bookingPending');
        $response->assertViewHas('totalLayanan');
        $response->assertViewHas('chartData');
    }

    /**
     * Test dashboard creates default settings if none exist.
     */
    public function test_dashboard_creates_default_settings_if_none_exist(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $this->assertDatabaseHas('landing_settings', [
            'hero_title' => 'Layanan Kebersihan',
        ]);
    }

    /**
     * Test dashboard has chart data with 12 months.
     */
    public function test_dashboard_has_chart_data_with_12_months(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        LandingSetting::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('chartData');
        
        $chartData = $response->viewData('chartData');
        $this->assertCount(12, $chartData);
    }

    /**
     * Test admin can update landing settings.
     */
    public function test_admin_can_update_landing_settings(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        LandingSetting::factory()->create();

        $response = $this->actingAs($admin)->put('/admin/settings/update', [
            'hero_title' => 'New Hero Title',
            'hero_description' => 'New Description',
            'show_ulasan' => 'on',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('landing_settings', [
            'hero_title' => 'New Hero Title',
        ]);
    }

    /**
     * Test admin can upload promo images.
     */
    public function test_admin_can_upload_promo_images(): void
    {
        if (!extension_loaded('gd')) {
            $this->markTestSkipped('GD extension is not installed.');
        }

        Storage::fake('public');
        
        $admin = User::factory()->create(['role' => 'admin']);
        LandingSetting::factory()->create();

        $response = $this->actingAs($admin)->put('/admin/settings/update', [
            'hero_title' => 'Test Title',
            'hero_description' => 'Test Description',
            'promo_1_image' => UploadedFile::fake()->image('promo1.jpg'),
        ]);

        $response->assertRedirect();
        
        $setting = LandingSetting::first();
        $this->assertNotNull($setting->promo_1_image);
    }

    /**
     * Test toggle settings are saved correctly.
     */
    public function test_toggle_settings_are_saved_correctly(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        LandingSetting::factory()->create([
            'show_ulasan' => false,
            'show_promotions' => false,
            'show_quick_support' => false,
        ]);

        $response = $this->actingAs($admin)->put('/admin/settings/update', [
            'hero_title' => 'Test',
            'hero_description' => 'Test',
            'show_ulasan' => 'on',
            'show_promotions' => 'on',
            'show_quick_support' => 'on',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('landing_settings', [
            'show_ulasan' => 1,
            'show_promotions' => 1,
            'show_quick_support' => 1,
        ]);
    }

    /**
     * Test guest cannot access admin dashboard.
     */
    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login');
    }

    /**
     * Test regular user cannot access admin dashboard.
     */
    public function test_regular_user_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        // Should be forbidden or redirected
        $this->assertTrue(
            $response->status() === 403 || 
            $response->status() === 302
        );
    }

    /**
     * Test admin can update settings when none exist.
     */
    public function test_admin_can_update_settings_when_none_exist(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->put('/admin/settings/update', [
            'hero_title' => 'New Hero Title',
            'hero_description' => 'New Description',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('landing_settings', [
            'hero_title' => 'New Hero Title',
        ]);
    }

    /**
     * Test update settings toggles default to off when not sent.
     */
    public function test_update_settings_toggles_default_to_off(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        LandingSetting::factory()->create([
            'show_ulasan' => true,
            'show_promotions' => true,
            'show_quick_support' => true,
        ]);

        $response = $this->actingAs($admin)->put('/admin/settings/update', [
            'hero_title' => 'Test Title',
            'hero_description' => 'Test Desc',
            // No toggles sent
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('landing_settings', [
            'show_ulasan' => 0,
            'show_promotions' => 0,
            'show_quick_support' => 0,
        ]);
    }
}
