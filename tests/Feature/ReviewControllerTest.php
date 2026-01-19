<?php

namespace Tests\Feature;

use App\Models\LandingSetting;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test authenticated user can view review form.
     */
    public function test_authenticated_user_can_view_review_form(): void
    {
        LandingSetting::factory()->create();
        Service::factory()->count(3)->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/write-review');

        $response->assertStatus(200);
        $response->assertViewIs('reviews.create');
        $response->assertViewHas('services');
    }

    /**
     * Test guest cannot view review form.
     */
    public function test_guest_cannot_view_review_form(): void
    {
        $response = $this->get('/write-review');

        $response->assertRedirect('/login');
    }

    /**
     * Test authenticated user can submit review.
     */
    public function test_authenticated_user_can_submit_review(): void
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
        $service = Service::factory()->create();

        $response = $this->actingAs($user)->post('/reviews', [
            'rating' => 5,
            'content' => 'Excellent service! Very satisfied.',
            'service_id' => $service->id,
        ]);

        $response->assertRedirect(route('home.landing'));
        $this->assertDatabaseHas('reviews', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'rating' => 5,
            'content' => 'Excellent service! Very satisfied.',
            'status' => 'approved',
        ]);
    }

    /**
     * Test review submission requires rating.
     */
    public function test_review_requires_rating(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/reviews', [
            'content' => 'Good service.',
        ]);

        $response->assertSessionHasErrors('rating');
    }

    /**
     * Test review submission requires content.
     */
    public function test_review_requires_content(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/reviews', [
            'rating' => 5,
        ]);

        $response->assertSessionHasErrors('content');
    }

    /**
     * Test review rating must be between 1 and 5.
     */
    public function test_review_rating_must_be_valid(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/reviews', [
            'rating' => 6,
            'content' => 'Good service.',
        ]);

        $response->assertSessionHasErrors('rating');
    }

    /**
     * Test review content has max length.
     */
    public function test_review_content_has_max_length(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/reviews', [
            'rating' => 5,
            'content' => str_repeat('a', 501),
        ]);

        $response->assertSessionHasErrors('content');
    }

    /**
     * Test review can be submitted without service.
     */
    public function test_review_can_be_submitted_without_service(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/reviews', [
            'rating' => 4,
            'content' => 'General positive feedback.',
        ]);

        $response->assertRedirect(route('home.landing'));
        $this->assertDatabaseHas('reviews', [
            'rating' => 4,
            'service_id' => null,
        ]);
    }

    /**
     * Test guest cannot submit review.
     */
    public function test_guest_cannot_submit_review(): void
    {
        $response = $this->post('/reviews', [
            'rating' => 5,
            'content' => 'Good service.',
        ]);

        $response->assertRedirect('/login');
    }
}
