<?php

namespace Tests\Feature\Admin;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminBookingControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test admin can view bookings index.
     */
    public function test_admin_can_view_bookings_index(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Booking::factory()->count(5)->create();

        $response = $this->actingAs($admin)->get('/bookings');

        $response->assertStatus(200);
        $response->assertViewIs('admin.bookings.index');
        $response->assertViewHas('bookings');
    }

    /**
     * Test admin can update booking status.
     */
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

    /**
     * Test admin can delete booking.
     */
    public function test_admin_can_delete_booking(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $booking = Booking::factory()->create();

        $response = $this->actingAs($admin)->delete("/bookings/{$booking->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('bookings', [
            'id' => $booking->id,
        ]);
    }

    /**
     * Test deleting non-existent booking returns 404.
     */
    public function test_deleting_non_existent_booking_returns_404(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->delete('/bookings/999');

        $response->assertStatus(404);
    }

    /**
     * Test updating non-existent booking returns 404.
     */
    public function test_updating_non_existent_booking_returns_404(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->put('/bookings/999/status', [
            'status' => 'approved',
        ]);

        $response->assertStatus(404);
    }

    /**
     * Test bookings are ordered by latest.
     */
    public function test_bookings_are_ordered_by_latest(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        $oldBooking = Booking::factory()->create(['created_at' => now()->subDays(2)]);
        $newBooking = Booking::factory()->create(['created_at' => now()]);

        $response = $this->actingAs($admin)->get('/bookings');

        $bookings = $response->viewData('bookings');
        $this->assertEquals($newBooking->id, $bookings->first()->id);
    }

    /**
     * Test bookings include service relationship.
     */
    public function test_bookings_include_service_relationship(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $service = Service::factory()->create(['name' => 'Test Service']);
        Booking::factory()->create(['service_id' => $service->id]);

        $response = $this->actingAs($admin)->get('/bookings');

        $bookings = $response->viewData('bookings');
        $this->assertTrue($bookings->first()->relationLoaded('service'));
    }
}
