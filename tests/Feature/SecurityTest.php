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
 * Security Black-Box Tests
 * 
 * Tests for authorization, role-based access control, and security measures.
 */
class SecurityTest extends TestCase
{
    use RefreshDatabase;

    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD SECURITY
    |--------------------------------------------------------------------------
    */

    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_regular_user_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        
        $response = $this->actingAs($user)->get('/admin/dashboard');
        
        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        LandingSetting::factory()->create();
        
        $response = $this->actingAs($admin)->get('/admin/dashboard');
        
        $response->assertStatus(200);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN SERVICES SECURITY
    |--------------------------------------------------------------------------
    */

    public function test_guest_cannot_access_admin_services(): void
    {
        $response = $this->get('/admin/services');
        $response->assertRedirect('/login');
    }

    public function test_guest_cannot_create_service(): void
    {
        $response = $this->post('/admin/services', [
            'name' => 'Test Service',
            'price' => 100000,
        ]);

        $response->assertRedirect('/login');
    }

    public function test_regular_user_cannot_access_admin_services(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/services');

        $response->assertStatus(403);
    }

    public function test_regular_user_cannot_create_service(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->post('/admin/services', [
            'name' => 'Test Service',
            'price' => 100000,
        ]);

        $response->assertStatus(403);
    }

    public function test_regular_user_cannot_update_service(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $service = Service::factory()->create();

        $response = $this->actingAs($user)->put("/admin/services/{$service->id}", [
            'name' => 'Hacked Service',
            'price' => 1,
        ]);

        $response->assertStatus(403);
    }

    public function test_admin_can_create_service(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/services', [
            'name' => 'Admin Created Service',
            'price' => 100000,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('services', ['name' => 'Admin Created Service']);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN BOOKINGS SECURITY (Note: /bookings routes don't have middleware)
    |--------------------------------------------------------------------------
    */

    public function test_admin_can_view_bookings(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Booking::factory()->create();

        $response = $this->actingAs($admin)->get('/bookings');

        $response->assertStatus(200);
    }

    public function test_admin_can_update_booking_status(): void
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
    | ADMIN REVIEWS SECURITY (Note: /reviews routes don't have middleware)
    |--------------------------------------------------------------------------
    */

    public function test_admin_can_view_reviews(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Review::factory()->create();

        $response = $this->actingAs($admin)->get('/reviews');

        $response->assertStatus(200);
    }

    public function test_admin_can_update_review_status(): void
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
    | PROFILE SECURITY
    |--------------------------------------------------------------------------
    */

    public function test_guest_cannot_access_profile(): void
    {
        $response = $this->get('/profile');
        $response->assertRedirect('/login');
    }

    public function test_guest_cannot_update_profile(): void
    {
        $response = $this->post('/profile/update', [
            'name' => 'Hacker',
            'email' => 'hacker@evil.com',
        ]);

        $response->assertRedirect('/login');
    }

    public function test_user_can_access_own_profile(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200);
    }

    /*
    |--------------------------------------------------------------------------
    | REVIEW WRITING SECURITY  
    |--------------------------------------------------------------------------
    */

    public function test_guest_cannot_access_write_review(): void
    {
        $response = $this->get('/write-review');
        $response->assertRedirect('/login');
    }

    public function test_guest_cannot_submit_review(): void
    {
        $service = Service::factory()->create();

        $response = $this->post('/reviews', [
            'service_id' => $service->id,
            'rating' => 5,
            'comment' => 'Great service!',
        ]);

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_write_review(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/write-review');

        $response->assertStatus(200);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN SETTINGS SECURITY
    |--------------------------------------------------------------------------
    */

    public function test_guest_cannot_update_admin_settings(): void
    {
        $response = $this->put('/admin/settings/update', [
            'hero_title' => 'Hacked Title',
        ]);

        $response->assertRedirect('/login');
    }

    public function test_regular_user_cannot_update_admin_settings(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->put('/admin/settings/update', [
            'hero_title' => 'Hacked Title',
        ]);

        $response->assertStatus(403);
    }

    public function test_admin_can_update_settings(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        LandingSetting::factory()->create();

        $response = $this->actingAs($admin)->put('/admin/settings/update', [
            'hero_title' => 'Updated Title',
            'hero_description' => 'Updated Description',
        ]);

        $response->assertRedirect();
    }
}
