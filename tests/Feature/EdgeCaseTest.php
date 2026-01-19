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
 * Edge Case Black-Box Tests
 * 
 * Tests for boundary values, empty data, invalid inputs, and edge cases.
 */
class EdgeCaseTest extends TestCase
{
    use RefreshDatabase;

    /*
    |--------------------------------------------------------------------------
    | SERVICE EDGE CASES
    |--------------------------------------------------------------------------
    */

    public function test_service_with_empty_name_fails_validation(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/services', [
            'name' => '',
            'price' => 100000,
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_service_with_special_characters_in_name_creates_valid_slug(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/services', [
            'name' => 'Cuci Karpet & Sofa @ Premium!',
            'price' => 100000,
        ]);

        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('services', [
            'name' => 'Cuci Karpet & Sofa @ Premium!',
            'slug' => 'cuci-karpet-sofa-at-premium',
        ]);
    }

    public function test_service_with_non_numeric_price_fails_validation(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/services', [
            'name' => 'Test Service',
            'price' => 'not-a-number',
        ]);

        $response->assertSessionHasErrors('price');
    }

    public function test_service_with_very_long_name_is_handled(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $longName = str_repeat('a', 300); // Exceeds 255 characters

        $response = $this->actingAs($admin)->post('/admin/services', [
            'name' => $longName,
            'price' => 100000,
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_service_with_zero_price_is_valid(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/services', [
            'name' => 'Free Service',
            'price' => 0,
        ]);

        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('services', [
            'name' => 'Free Service',
            'price' => 0,
        ]);
    }

    public function test_accessing_nonexistent_service_returns_404(): void
    {
        $response = $this->get('/services/nonexistent-slug-12345');
        $response->assertStatus(404);
    }

    /*
    |--------------------------------------------------------------------------
    | BOOKING EDGE CASES
    |--------------------------------------------------------------------------
    */

    public function test_updating_nonexistent_booking_returns_404(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->put('/bookings/99999/status', [
            'status' => 'approved',
        ]);

        $response->assertStatus(404);
    }

    public function test_deleting_nonexistent_booking_returns_404(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->delete('/bookings/99999');

        $response->assertStatus(404);
    }

    public function test_bookings_page_with_no_bookings_shows_empty_state(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/bookings');

        $response->assertStatus(200);
        $response->assertViewHas('bookings');
    }

    /*
    |--------------------------------------------------------------------------
    | REVIEW EDGE CASES
    |--------------------------------------------------------------------------
    */

    public function test_updating_nonexistent_review_returns_404(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->put('/reviews/99999/status', [
            'status' => 'approved',
        ]);

        $response->assertStatus(404);
    }

    public function test_deleting_nonexistent_review_returns_404(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->delete('/reviews/99999');

        $response->assertStatus(404);
    }

    public function test_review_with_invalid_status_fails(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $review = Review::factory()->create();

        $response = $this->actingAs($admin)->put("/reviews/{$review->id}/status", [
            'status' => 'invalid_status_here',
        ]);

        $response->assertSessionHasErrors('status');
    }

    /*
    |--------------------------------------------------------------------------
    | AUTH EDGE CASES
    |--------------------------------------------------------------------------
    */

    public function test_login_with_empty_credentials_fails(): void
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['email', 'password']);
    }

    public function test_login_with_invalid_email_format_fails(): void
    {
        $response = $this->post('/login', [
            'email' => 'not-an-email',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_login_with_wrong_password_fails(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('correct-password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    public function test_register_with_mismatched_password_confirmation_fails(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'different-password',
        ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_register_with_short_password_fails(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123',
            'password_confirmation' => '123',
        ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_register_with_duplicate_email_fails(): void
    {
        User::factory()->create(['email' => 'existing@example.com']);

        $response = $this->post('/register', [
            'name' => 'New User',
            'email' => 'existing@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /*
    |--------------------------------------------------------------------------
    | PROFILE EDGE CASES
    |--------------------------------------------------------------------------
    */

    public function test_profile_update_with_empty_name_fails(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/profile/update', [
            'name' => '',
            'email' => 'valid@example.com',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_profile_update_with_invalid_phone_fails(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/profile/update', [
            'name' => 'Valid Name',
            'phone' => 'not-a-phone-number', // Should be numeric
        ]);

        $response->assertSessionHasErrors('phone');
    }

    public function test_password_change_with_wrong_current_password_fails(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('current-password'),
        ]);

        $response = $this->actingAs($user)->post('/profile/password', [
            'current_password' => 'wrong-current-password',
            'password' => 'new-password123',
            'password_confirmation' => 'new-password123',
        ]);

        $response->assertSessionHasErrors();
    }

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD EDGE CASES
    |--------------------------------------------------------------------------
    */

    public function test_dashboard_with_no_data_still_loads(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        LandingSetting::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('totalPendapatan', 0);
        $response->assertViewHas('totalBooking', 0);
    }

    public function test_homepage_loads_without_services(): void
    {
        LandingSetting::factory()->create();

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_services_page_loads_without_services(): void
    {
        LandingSetting::factory()->create();

        $response = $this->get('/services');

        $response->assertStatus(200);
    }
}
