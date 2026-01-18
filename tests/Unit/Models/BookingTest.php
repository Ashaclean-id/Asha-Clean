<?php

namespace Tests\Unit\Models;

use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test booking belongs to a service.
     */
    public function test_belongs_to_service(): void
    {
        $service = Service::factory()->create();
        $booking = Booking::factory()->create(['service_id' => $service->id]);

        $this->assertInstanceOf(Service::class, $booking->service);
        $this->assertEquals($service->id, $booking->service->id);
    }

    /**
     * Test booking has many items.
     */
    public function test_has_many_items(): void
    {
        $booking = Booking::factory()->create();
        $items = BookingItem::factory()->count(3)->create(['booking_id' => $booking->id]);

        $this->assertCount(3, $booking->items);
        $this->assertInstanceOf(BookingItem::class, $booking->items->first());
    }

    /**
     * Test factory creates valid booking.
     */
    public function test_factory_creates_valid_booking(): void
    {
        $booking = Booking::factory()->create();

        $this->assertNotNull($booking->id);
        $this->assertNotNull($booking->service_id);
        $this->assertNotNull($booking->name);
        $this->assertNotNull($booking->phone);
        $this->assertNotNull($booking->address);
        $this->assertEquals('pending', $booking->status);
        $this->assertEquals('unpaid', $booking->payment_status);
    }

    /**
     * Test booking with user.
     */
    public function test_booking_with_user(): void
    {
        $booking = Booking::factory()->withUser()->create();

        $this->assertNotNull($booking->user_id);
    }

    /**
     * Test paid booking state.
     */
    public function test_paid_booking_state(): void
    {
        $booking = Booking::factory()->paid()->create();

        $this->assertEquals('paid', $booking->payment_status);
        $this->assertEquals('approved', $booking->status);
    }

    /**
     * Test booking with snap token.
     */
    public function test_booking_with_snap_token(): void
    {
        $booking = Booking::factory()->withSnapToken()->create();

        $this->assertNotNull($booking->snap_token);
    }

    /**
     * Test booking can be created with all required fields.
     */
    public function test_can_create_booking_with_required_fields(): void
    {
        $service = Service::factory()->create();

        $booking = Booking::create([
            'service_id' => $service->id,
            'name' => 'John Doe',
            'phone' => '081234567890',
            'address' => 'Jl. Test No. 123',
            'booking_date' => '2026-01-20',
            'booking_time' => '10:00',
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'total_price' => 150000,
        ]);

        $this->assertDatabaseHas('bookings', [
            'name' => 'John Doe',
            'phone' => '081234567890',
        ]);
    }
}
