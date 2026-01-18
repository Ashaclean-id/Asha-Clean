<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\LandingSetting;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Integration Black-Box Tests
 * 
 * Tests for complete user flows and multi-step processes.
 */
class IntegrationTest extends TestCase
{
    use RefreshDatabase;

    /*
    |--------------------------------------------------------------------------
    | REGISTRATION AND LOGIN FLOW
    |--------------------------------------------------------------------------
    */

    public function test_complete_registration_and_login_flow(): void
    {
        // Step 1: Visit registration page
        $response = $this->get('/register');
        $response->assertStatus(200);

        // Step 2: Submit registration
        $response = $this->post('/register', [
            'name' => 'Integration Test User',
            'email' => 'integration@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'email' => 'integration@test.com',
        ]);

        // Step 3: Logout (if auto-logged in)
        $this->post('/logout');

        // Step 4: Login with new credentials
        $response = $this->post('/login', [
            'email' => 'integration@test.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect();
        $this->assertAuthenticated();
    }

    public function test_login_logout_flow(): void
    {
        $user = User::factory()->create([
            'email' => 'user@test.com',
            'password' => bcrypt('password123'),
        ]);

        // Step 1: Login
        $response = $this->post('/login', [
            'email' => 'user@test.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticated();

        // Step 2: Access protected page
        $response = $this->actingAs($user)->get('/profile');
        $response->assertStatus(200);

        // Step 3: Logout
        $response = $this->actingAs($user)->post('/logout');
        $response->assertRedirect();
    }

    /*
    |--------------------------------------------------------------------------
    | SERVICE MANAGEMENT FLOW (ADMIN)
    |--------------------------------------------------------------------------
    */

    public function test_admin_complete_service_crud_flow(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        // Step 1: View services list
        $response = $this->actingAs($admin)->get('/admin/services');
        $response->assertStatus(200);

        // Step 2: Create new service
        $response = $this->actingAs($admin)->post('/admin/services', [
            'name' => 'Integration Test Service',
            'price' => 250000,
            'is_active' => true,
        ]);
        $response->assertRedirect(route('admin.services.index'));

        $service = Service::where('name', 'Integration Test Service')->first();
        $this->assertNotNull($service);

        // Step 3: Edit service
        $response = $this->actingAs($admin)->get("/admin/services/{$service->id}/edit");
        $response->assertStatus(200);

        // Step 4: Update service
        $response = $this->actingAs($admin)->put("/admin/services/{$service->id}", [
            'name' => 'Updated Integration Service',
            'price' => 300000,
        ]);
        $response->assertRedirect(route('admin.services.index'));

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'name' => 'Updated Integration Service',
            'price' => 300000,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | REVIEW MANAGEMENT FLOW (ADMIN)
    |--------------------------------------------------------------------------
    */

    public function test_admin_review_moderation_flow(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        // Create pending reviews
        $review1 = Review::factory()->pending()->create();
        $review2 = Review::factory()->pending()->create();

        // Step 1: View reviews list
        $response = $this->actingAs($admin)->get('/reviews');
        $response->assertStatus(200);
        $response->assertViewHas('pendingReviews');

        // Step 2: Approve first review
        $response = $this->actingAs($admin)->put("/reviews/{$review1->id}/status", [
            'status' => 'approved',
        ]);
        $response->assertRedirect();

        $this->assertDatabaseHas('reviews', [
            'id' => $review1->id,
            'status' => 'approved',
        ]);

        // Step 3: Hide second review
        $response = $this->actingAs($admin)->put("/reviews/{$review2->id}/status", [
            'status' => 'hidden',
        ]);

        $this->assertDatabaseHas('reviews', [
            'id' => $review2->id,
            'status' => 'hidden',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | BOOKING MANAGEMENT FLOW (ADMIN)
    |--------------------------------------------------------------------------
    */

    public function test_admin_booking_management_flow(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        // Create pending bookings
        $booking = Booking::factory()->create(['status' => 'pending']);

        // Step 1: View bookings list
        $response = $this->actingAs($admin)->get('/bookings');
        $response->assertStatus(200);

        // Step 2: Approve booking
        $response = $this->actingAs($admin)->put("/bookings/{$booking->id}/status", [
            'status' => 'approved',
        ]);
        $response->assertRedirect();

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'approved',
        ]);

        // Step 3: Delete booking
        $response = $this->actingAs($admin)->delete("/bookings/{$booking->id}");
        $response->assertRedirect();

        $this->assertDatabaseMissing('bookings', [
            'id' => $booking->id,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | USER PROFILE MANAGEMENT FLOW
    |--------------------------------------------------------------------------
    */

    public function test_user_profile_update_flow(): void
    {
        $user = User::factory()->create([
            'name' => 'Original Name',
            'phone' => '08123456789',
            'address' => 'Original Address',
        ]);

        // Step 1: View profile
        $response = $this->actingAs($user)->get('/profile');
        $response->assertStatus(200);

        // Step 2: Update profile info (name, phone, address only - not email)
        $response = $this->actingAs($user)->post('/profile/update', [
            'name' => 'Updated Name',
            'phone' => '08987654321',
            'address' => 'Updated Address',
        ]);
        $response->assertRedirect();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'phone' => '08987654321',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | REVIEW SUBMISSION FLOW (USER)
    |--------------------------------------------------------------------------
    */

    public function test_user_submit_review_flow(): void
    {
        $user = User::factory()->create();
        $service = Service::factory()->create();

        // Step 1: Access write review page
        $response = $this->actingAs($user)->get('/write-review');
        $response->assertStatus(200);

        // Step 2: Submit review (uses 'content' not 'comment')
        $response = $this->actingAs($user)->post('/reviews', [
            'service_id' => $service->id,
            'rating' => 5,
            'content' => 'Excellent service! Very satisfied.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('reviews', [
            'name' => $user->name,
            'service_id' => $service->id,
            'rating' => 5,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | PUBLIC BROWSING FLOW
    |--------------------------------------------------------------------------
    */

    public function test_public_browsing_services_flow(): void
    {
        LandingSetting::factory()->create();
        $service = Service::factory()->create([
            'slug' => 'test-service',
            'is_active' => true,
        ]);

        // Step 1: Visit homepage
        $response = $this->get('/');
        $response->assertStatus(200);

        // Step 2: Visit services list
        $response = $this->get('/services');
        $response->assertStatus(200);

        // Step 3: View specific service
        $response = $this->get('/services/test-service');
        $response->assertStatus(200);
        $response->assertViewHas('service');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD SETTINGS FLOW
    |--------------------------------------------------------------------------
    */

    public function test_admin_update_landing_settings_flow(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        LandingSetting::factory()->create();

        // Step 1: View dashboard
        $response = $this->actingAs($admin)->get('/admin/dashboard');
        $response->assertStatus(200);
        $response->assertViewHas('setting');

        // Step 2: Update settings
        $response = $this->actingAs($admin)->put('/admin/settings/update', [
            'hero_title' => 'New Landing Title',
            'hero_description' => 'New landing description for the page.',
            'show_ulasan' => 'on',
            'show_promotions' => 'on',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('landing_settings', [
            'hero_title' => 'New Landing Title',
            'show_ulasan' => 1,
            'show_promotions' => 1,
        ]);
    }
}
