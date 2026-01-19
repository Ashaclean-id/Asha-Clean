<?php

namespace Tests\Feature\Admin;

use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminReviewControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test admin can view reviews index.
     */
    public function test_admin_can_view_reviews_index(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Review::factory()->count(5)->create();

        $response = $this->actingAs($admin)->get('/reviews');

        $response->assertStatus(200);
        $response->assertViewIs('admin.reviews.index');
        $response->assertViewHas('reviews');
        $response->assertViewHas('totalReviews');
        $response->assertViewHas('avgRating');
        $response->assertViewHas('pendingReviews');
    }

    /**
     * Test reviews index shows correct statistics.
     */
    public function test_reviews_index_shows_correct_statistics(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Review::factory()->count(3)->create(['rating' => 5, 'status' => 'approved']);
        Review::factory()->count(2)->create(['rating' => 4, 'status' => 'pending']);

        $response = $this->actingAs($admin)->get('/reviews');

        $this->assertEquals(5, $response->viewData('totalReviews'));
        $this->assertEquals(2, $response->viewData('pendingReviews'));
    }

    /**
     * Test admin can update review status to approved.
     */
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

    /**
     * Test admin can update review status to hidden.
     */
    public function test_admin_can_hide_review(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $review = Review::factory()->create();

        $response = $this->actingAs($admin)->put("/reviews/{$review->id}/status", [
            'status' => 'hidden',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('reviews', [
            'id' => $review->id,
            'status' => 'hidden',
        ]);
    }

    /**
     * Test admin cannot set invalid review status.
     */
    public function test_admin_cannot_set_invalid_status(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $review = Review::factory()->create();

        $response = $this->actingAs($admin)->put("/reviews/{$review->id}/status", [
            'status' => 'invalid_status',
        ]);

        $response->assertSessionHasErrors('status');
    }

    /**
     * Test admin can delete review.
     */
    public function test_admin_can_delete_review(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $review = Review::factory()->create();

        $response = $this->actingAs($admin)->delete("/reviews/{$review->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('reviews', [
            'id' => $review->id,
        ]);
    }

    /**
     * Test deleting non-existent review returns 404.
     */
    public function test_deleting_non_existent_review_returns_404(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->delete('/reviews/999');

        $response->assertStatus(404);
    }

    /**
     * Test reviews include service relationship.
     */
    public function test_reviews_include_service_relationship(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $service = Service::factory()->create();
        Review::factory()->create(['service_id' => $service->id]);

        $response = $this->actingAs($admin)->get('/reviews');

        $reviews = $response->viewData('reviews');
        $this->assertTrue($reviews->first()->relationLoaded('service'));
    }

    /**
     * Test reviews are ordered by latest.
     */
    public function test_reviews_are_ordered_by_latest(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        $oldReview = Review::factory()->create(['created_at' => now()->subDays(2)]);
        $newReview = Review::factory()->create(['created_at' => now()]);

        $response = $this->actingAs($admin)->get('/reviews');

        $reviews = $response->viewData('reviews');
        $this->assertEquals($newReview->id, $reviews->first()->id);
    }
}
