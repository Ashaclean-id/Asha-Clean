<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\LandingSetting;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PesanControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test booking form is displayed.
     */
    public function test_booking_form_is_displayed(): void
    {
        $service = Service::factory()->create();

        $response = $this->get("/pesan/{$service->id}");

        $response->assertStatus(200);
        $response->assertViewIs('pesan.index');
        $response->assertViewHas('service');
        $response->assertViewHas('selectedItems');
        $response->assertViewHas('totalPrice');
    }

    /**
     * Test booking form with custom items.
     */
    public function test_booking_form_with_custom_items(): void
    {
        $service = Service::factory()->create();

        $response = $this->get("/pesan/{$service->id}", [
            'custom_items' => ['Cuci Sofa|150000', 'Cuci Karpet|100000'],
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('pesan.index');
    }

    /**
     * Test booking form uses default price when no items.
     */
    public function test_booking_form_uses_default_price(): void
    {
        $service = Service::factory()->create(['price' => 200000]);

        $response = $this->get("/pesan/{$service->id}");

        $response->assertStatus(200);
        $response->assertViewHas('totalPrice', 200000);
    }

    /**
     * Test booking submission validation.
     */
    public function test_booking_submission_requires_validation(): void
    {
        $response = $this->post('/pesan', []);

        $response->assertSessionHasErrors(['service_id', 'name', 'phone', 'address', 'booking_date', 'booking_time']);
    }

    /**
     * Test booking submission requires valid service.
     */
    public function test_booking_requires_valid_service(): void
    {
        $response = $this->post('/pesan', [
            'service_id' => 999,
            'name' => 'John Doe',
            'phone' => '081234567890',
            'address' => 'Jl. Test',
            'booking_date' => '2026-01-20',
            'booking_time' => '10:00',
        ]);

        $response->assertSessionHasErrors('service_id');
    }

    /**
     * Test payment page is displayed.
     */
    public function test_payment_page_is_displayed(): void
    {
        LandingSetting::factory()->create();
        $booking = Booking::factory()->withSnapToken()->create();

        $response = $this->get("/pembayaran/{$booking->id}");

        $response->assertStatus(200);
        $response->assertViewIs('pesan.payment');
        $response->assertViewHas('booking');
    }

    /**
     * Test payment page redirects if no snap token.
     */
    public function test_payment_page_redirects_without_snap_token(): void
    {
        LandingSetting::factory()->create();
        $booking = Booking::factory()->create(['snap_token' => null]);

        $response = $this->get("/pembayaran/{$booking->id}");

        $response->assertRedirect(route('home.landing'));
        $response->assertSessionHas('error');
    }

    /**
     * Test success page is displayed.
     */
    public function test_success_page_is_displayed(): void
    {
        LandingSetting::factory()->create();
        $booking = Booking::factory()->create([
            'payment_status' => 'unpaid',
            'status' => 'pending',
        ]);

        $response = $this->get("/pembayaran/sukses/{$booking->id}");

        $response->assertStatus(200);
        $response->assertViewIs('pesan.success');
    }

    /**
     * Test success page updates booking status.
     */
    public function test_success_page_updates_booking_status(): void
    {
        LandingSetting::factory()->create();
        $booking = Booking::factory()->create([
            'payment_status' => 'unpaid',
            'status' => 'pending',
        ]);

        $this->get("/pembayaran/sukses/{$booking->id}");

        $booking->refresh();
        $this->assertEquals('paid', $booking->payment_status);
        $this->assertEquals('approved', $booking->status);
    }

    /**
     * Test success page does not update already paid booking.
     */
    public function test_success_page_does_not_update_paid_booking(): void
    {
        LandingSetting::factory()->create();
        $booking = Booking::factory()->create([
            'payment_status' => 'paid',
            'status' => 'approved',
        ]);

        $this->get("/pembayaran/sukses/{$booking->id}");

        $booking->refresh();
        $this->assertEquals('paid', $booking->payment_status);
        $this->assertEquals('approved', $booking->status);
    }

    /**
     * Test index method parses custom items correctly.
     */
    public function test_index_parses_custom_items_correctly(): void
    {
        $service = Service::factory()->create(['price' => 100000]);

        // POST with custom_items - the index method accepts GET but also works with form data
        $response = $this->call('GET', "/pesan/{$service->id}", [
            'custom_items' => ['Cuci Sofa|150000', 'Cuci Karpet|100000'],
        ]);

        $response->assertStatus(200);
        $response->assertViewHas('selectedItems');
        $response->assertViewHas('totalPrice', 250000);
    }

    /**
     * Test index method with malformed custom items.
     */
    public function test_index_handles_malformed_custom_items(): void
    {
        $service = Service::factory()->create(['price' => 100000]);

        // Custom items without proper format (missing |)
        $response = $this->call('GET', "/pesan/{$service->id}", [
            'custom_items' => ['InvalidFormat'],
        ]);

        // Controller still works but totalPrice is 0 because malformed items are skipped
        // (controller checks count($parts) == 2 before adding to total)
        $response->assertStatus(200);
        $response->assertViewHas('totalPrice', 0);
    }

    /**
     * Test submit validates phone is numeric.
     */
    public function test_submit_validates_phone_is_numeric(): void
    {
        $service = Service::factory()->create();

        $response = $this->post('/pesan', [
            'service_id' => $service->id,
            'name' => 'Test User',
            'phone' => 'not-a-number',
            'address' => 'Jl. Test',
            'booking_date' => '2026-01-25',
            'booking_time' => '10:00',
        ]);

        $response->assertSessionHasErrors('phone');
    }

    /**
     * Test submit validates booking date is required.
     */
    public function test_submit_validates_booking_date_required(): void
    {
        $service = Service::factory()->create();

        $response = $this->post('/pesan', [
            'service_id' => $service->id,
            'name' => 'Test User',
            'phone' => '081234567890',
            'address' => 'Jl. Test',
            'booking_time' => '10:00',
        ]);

        $response->assertSessionHasErrors('booking_date');
    }

    /**
     * Test submit validates address is required.
     */
    public function test_submit_validates_address_required(): void
    {
        $service = Service::factory()->create();

        $response = $this->post('/pesan', [
            'service_id' => $service->id,
            'name' => 'Test User',
            'phone' => '081234567890',
            'booking_date' => '2026-01-25',
            'booking_time' => '10:00',
        ]);

        $response->assertSessionHasErrors('address');
    }

    /**
     * Test submit validates name is required.
     */
    public function test_submit_validates_name_required(): void
    {
        $service = Service::factory()->create();

        $response = $this->post('/pesan', [
            'service_id' => $service->id,
            'phone' => '081234567890',
            'address' => 'Jl. Test',
            'booking_date' => '2026-01-25',
            'booking_time' => '10:00',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /**
     * Test booking form displays for non-existent service returns 404.
     */
    public function test_booking_form_for_nonexistent_service_returns_404(): void
    {
        $response = $this->get('/pesan/9999');

        $response->assertStatus(404);
    }
}

