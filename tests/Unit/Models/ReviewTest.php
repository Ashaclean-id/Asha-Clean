<?php

namespace Tests\Unit\Models;

use App\Models\Review;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test review belongs to a service.
     */
    public function test_belongs_to_service(): void
    {
        $service = Service::factory()->create();
        $review = Review::factory()->create(['service_id' => $service->id]);

        $this->assertInstanceOf(Service::class, $review->service);
        $this->assertEquals($service->id, $review->service->id);
    }

    /**
     * Test review can exist without service.
     */
    public function test_can_exist_without_service(): void
    {
        $review = Review::factory()->withoutService()->create();

        $this->assertNull($review->service_id);
        $this->assertNull($review->service);
    }

    /**
     * Test factory creates valid review.
     */
    public function test_factory_creates_valid_review(): void
    {
        $review = Review::factory()->create();

        $this->assertNotNull($review->id);
        $this->assertNotNull($review->name);
        $this->assertNotNull($review->email);
        $this->assertNotNull($review->rating);
        $this->assertNotNull($review->content);
        $this->assertEquals('approved', $review->status);
    }

    /**
     * Test pending review state.
     */
    public function test_pending_review_state(): void
    {
        $review = Review::factory()->pending()->create();

        $this->assertEquals('pending', $review->status);
    }

    /**
     * Test hidden review state.
     */
    public function test_hidden_review_state(): void
    {
        $review = Review::factory()->hidden()->create();

        $this->assertEquals('hidden', $review->status);
    }

    /**
     * Test review rating is within valid range.
     */
    public function test_rating_is_within_valid_range(): void
    {
        $review = Review::factory()->create();

        $this->assertGreaterThanOrEqual(1, $review->rating);
        $this->assertLessThanOrEqual(5, $review->rating);
    }

    /**
     * Test review can be created with all required fields.
     */
    public function test_can_create_review_with_required_fields(): void
    {
        $service = Service::factory()->create();

        $review = Review::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'rating' => 5,
            'content' => 'Excellent service!',
            'service_id' => $service->id,
            'status' => 'approved',
        ]);

        $this->assertDatabaseHas('reviews', [
            'name' => 'John Doe',
            'rating' => 5,
        ]);
    }
}
