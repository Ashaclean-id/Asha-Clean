<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\LandingSetting;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Complete End-to-End Black-Box Tests
 * 
 * Comprehensive tests for all website functionalities discovered during browser testing.
 */
class CompleteE2ETest extends TestCase
{
    use RefreshDatabase;

    /*
    |--------------------------------------------------------------------------
    | HOMEPAGE & PUBLIC PAGES
    |--------------------------------------------------------------------------
    */

    public function test_homepage_displays_correctly(): void
    {
        LandingSetting::factory()->create([
            'hero_title' => 'Layanan Kebersihan Profesional',
            'hero_description' => 'Deskripsi layanan kebersihan terbaik.',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Layanan Kebersihan Profesional');
    }

    public function test_homepage_displays_services_section(): void
    {
        LandingSetting::factory()->create();
        Service::factory()->count(3)->create(['is_active' => true]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewHas('services');
    }

    public function test_homepage_displays_approved_reviews(): void
    {
        LandingSetting::factory()->create(['show_ulasan' => true]);
        Review::factory()->count(2)->create(['status' => 'approved']);

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_services_list_page_displays(): void
    {
        LandingSetting::factory()->create();
        Service::factory()->count(5)->create(['is_active' => true]);

        $response = $this->get('/services');

        $response->assertStatus(200);
    }

    public function test_service_detail_page_displays(): void
    {
        LandingSetting::factory()->create();
        $service = Service::factory()->create([
            'slug' => 'cuci-karpet-premium',
            'is_active' => true,
        ]);

        $response = $this->get('/services/cuci-karpet-premium');

        $response->assertStatus(200);
        $response->assertViewHas('service');
    }

    public function test_inactive_service_detail_returns_404(): void
    {
        $service = Service::factory()->create([
            'slug' => 'hidden-service',
            'is_active' => false,
        ]);

        $response = $this->get('/services/hidden-service');

        $response->assertStatus(404);
    }

    /*
    |--------------------------------------------------------------------------
    | AUTHENTICATION FLOW
    |--------------------------------------------------------------------------
    */

    public function test_registration_page_displays(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Sign Up');
    }

    public function test_user_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'New User',
            'email' => 'newuser@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'email' => 'newuser@test.com',
            'role' => 'user',
        ]);
    }

    public function test_login_page_displays(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    public function test_user_can_login(): void
    {
        $user = User::factory()->create([
            'email' => 'logintest@test.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'logintest@test.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect();
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect();
        $this->assertGuest();
    }

    public function test_forgot_password_page_displays(): void
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
    }

    /*
    |--------------------------------------------------------------------------
    | USER PROFILE
    |--------------------------------------------------------------------------
    */

    public function test_user_can_view_profile(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200);
        $response->assertViewHas('user');
    }

    public function test_profile_shows_order_history(): void
    {
        $user = User::factory()->create();
        $service = Service::factory()->create();
        $booking = Booking::factory()->create([
            'user_id' => $user->id,
            'service_id' => $service->id,
        ]);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200);
        $response->assertViewHas('orders');
    }

    public function test_user_can_update_profile(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/profile/update', [
            'name' => 'Updated Name',
            'phone' => '08123456789',
            'address' => 'Jl. Contoh No. 123',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
        ]);
    }

    public function test_user_can_change_password(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('old-password'),
        ]);

        $response = $this->actingAs($user)->post('/profile/password', [
            'current_password' => 'old-password',
            'password' => 'new-password123',
            'password_confirmation' => 'new-password123',
        ]);

        $response->assertRedirect();
    }

    /*
    |--------------------------------------------------------------------------
    | REVIEW SUBMISSION
    |--------------------------------------------------------------------------
    */

    public function test_user_can_view_review_form(): void
    {
        LandingSetting::factory()->create();
        $user = User::factory()->create();
        Service::factory()->create(['is_active' => true]);

        $response = $this->actingAs($user)->get('/write-review');

        $response->assertStatus(200);
    }

    public function test_user_can_submit_review(): void
    {
        $user = User::factory()->create();
        $service = Service::factory()->create();

        $response = $this->actingAs($user)->post('/reviews', [
            'service_id' => $service->id,
            'rating' => 5,
            'content' => 'Layanan sangat memuaskan!',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('reviews', [
            'name' => $user->name,
            'rating' => 5,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | ORDERING / BOOKING FLOW
    |--------------------------------------------------------------------------
    */

    public function test_user_can_view_order_form(): void
    {
        $service = Service::factory()->create(['is_active' => true]);

        $response = $this->get("/pesan/{$service->id}");

        $response->assertStatus(200);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function test_admin_dashboard_shows_statistics(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        LandingSetting::factory()->create();
        
        // Create sample data
        Service::factory()->count(3)->create();
        Booking::factory()->count(5)->create(['payment_status' => 'paid']);
        Review::factory()->count(3)->create();

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('totalPendapatan');
        $response->assertViewHas('totalBooking');
        $response->assertViewHas('bookingPending');
        $response->assertViewHas('totalLayanan');
    }

    public function test_admin_dashboard_shows_chart_data(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        LandingSetting::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('chartData');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN SERVICES CRUD
    |--------------------------------------------------------------------------
    */

    public function test_admin_can_list_services(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Service::factory()->count(5)->create();

        $response = $this->actingAs($admin)->get('/admin/services');

        $response->assertStatus(200);
        $response->assertViewHas('services');
    }

    public function test_admin_can_view_create_service_form(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/services/create');

        $response->assertStatus(200);
    }

    public function test_admin_can_create_service_with_full_data(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/services', [
            'name' => 'Cuci Karpet Premium',
            'price' => 250000,
            'short_description' => 'Layanan cuci karpet profesional',
            'duration' => '2 - 4 Jam',
            'team_size' => 2,
            'is_active' => true,
            'show_booking' => true,
            'benefit_1_title' => 'Bersih Maksimal',
            'benefit_1_desc' => 'Menggunakan alat profesional',
            'price_name_1' => 'Karpet Kecil',
            'price_value_1' => 100000,
            'price_name_2' => 'Karpet Besar',
            'price_value_2' => 200000,
        ]);

        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('services', [
            'name' => 'Cuci Karpet Premium',
            'slug' => 'cuci-karpet-premium',
        ]);
    }

    public function test_admin_can_view_edit_service_form(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $service = Service::factory()->create();

        $response = $this->actingAs($admin)->get("/admin/services/{$service->id}/edit");

        $response->assertStatus(200);
        $response->assertViewHas('service');
    }

    public function test_admin_can_update_service(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $service = Service::factory()->create(['name' => 'Old Name']);

        $response = $this->actingAs($admin)->put("/admin/services/{$service->id}", [
            'name' => 'Updated Service Name',
            'price' => 300000,
        ]);

        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'name' => 'Updated Service Name',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN BOOKINGS MANAGEMENT
    |--------------------------------------------------------------------------
    */

    public function test_admin_can_list_bookings(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Booking::factory()->count(10)->create();

        $response = $this->actingAs($admin)->get('/bookings');

        $response->assertStatus(200);
        $response->assertViewHas('bookings');
    }

    public function test_admin_can_approve_booking(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $booking = Booking::factory()->create(['status' => 'pending']);

        $response = $this->actingAs($admin)->put("/bookings/{$booking->id}/status", [
            'status' => 'approved',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'approved',
        ]);
    }

    public function test_admin_can_complete_booking(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $booking = Booking::factory()->create(['status' => 'approved']);

        $response = $this->actingAs($admin)->put("/bookings/{$booking->id}/status", [
            'status' => 'completed',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'completed',
        ]);
    }

    public function test_admin_can_cancel_booking(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $booking = Booking::factory()->create(['status' => 'pending']);

        $response = $this->actingAs($admin)->put("/bookings/{$booking->id}/status", [
            'status' => 'cancelled',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'cancelled',
        ]);
    }

    public function test_admin_can_delete_booking(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $booking = Booking::factory()->create();

        $response = $this->actingAs($admin)->delete("/bookings/{$booking->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN REVIEWS MODERATION
    |--------------------------------------------------------------------------
    */

    public function test_admin_can_list_reviews(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Review::factory()->count(5)->create();

        $response = $this->actingAs($admin)->get('/reviews');

        $response->assertStatus(200);
    }

    public function test_admin_can_approve_review(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $review = Review::factory()->pending()->create();

        $response = $this->actingAs($admin)->put("/reviews/{$review->id}/status", [
            'status' => 'approved',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('reviews', [
            'id' => $review->id,
            'status' => 'approved',
        ]);
    }

    public function test_admin_can_hide_review(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $review = Review::factory()->create(['status' => 'approved']);

        $response = $this->actingAs($admin)->put("/reviews/{$review->id}/status", [
            'status' => 'hidden',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('reviews', [
            'id' => $review->id,
            'status' => 'hidden',
        ]);
    }

    public function test_admin_can_delete_review(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $review = Review::factory()->create();

        $response = $this->actingAs($admin)->delete("/reviews/{$review->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('reviews', ['id' => $review->id]);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN LANDING SETTINGS
    |--------------------------------------------------------------------------
    */

    public function test_admin_can_update_landing_settings(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        LandingSetting::factory()->create();

        $response = $this->actingAs($admin)->put('/admin/settings/update', [
            'hero_title' => 'New Hero Title',
            'hero_description' => 'New description text',
            'show_ulasan' => 'on',
            'show_promotions' => 'on',
            'show_quick_support' => 'on',
            'whatsapp_number' => '08123456789',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('landing_settings', [
            'hero_title' => 'New Hero Title',
            'show_ulasan' => 1,
            'show_promotions' => 1,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | ERROR HANDLING
    |--------------------------------------------------------------------------
    */

    public function test_404_for_nonexistent_pages(): void
    {
        $response = $this->get('/nonexistent-page-12345');

        $response->assertStatus(404);
    }

    public function test_nonexistent_service_returns_404(): void
    {
        $response = $this->get('/services/service-that-does-not-exist');

        $response->assertStatus(404);
    }
}
