<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /**
     * Test authenticated user can view profile.
     */
    public function test_authenticated_user_can_view_profile(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200);
        // View name could be 'profile' or 'profile.index' depending on controller
        $response->assertSuccessful();
    }

    /**
     * Test guest cannot view profile.
     */
    public function test_guest_cannot_view_profile(): void
    {
        $response = $this->get('/profile');

        $response->assertRedirect('/login');
    }

    /**
     * Test user can update profile information.
     */
    public function test_user_can_update_profile(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/profile/update', [
            'name' => 'Updated Name',
            'phone' => '081234567890',
            'address' => 'Updated Address',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'phone' => '081234567890',
            'address' => 'Updated Address',
        ]);
    }

    /**
     * Test user can update password.
     */
    public function test_user_can_update_password(): void
    {
        $user = User::factory()->create([
            'password' => 'oldpassword',
        ]);

        $response = $this->actingAs($user)->post('/profile/password', [
            'current_password' => 'oldpassword',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertRedirect();
        $user->refresh();
        $this->assertTrue(Hash::check('newpassword123', $user->password));
    }

    /**
     * Test user can upload avatar.
     * @requires extension gd
     */
    public function test_user_can_upload_avatar(): void
    {
        if (!function_exists('imagecreatetruecolor')) {
            $this->markTestSkipped('GD extension is not installed.');
        }
        
        $user = User::factory()->create();
        $image = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($user)->post('/profile/avatar', [
            'avatar' => $image,
        ]);

        $response->assertRedirect();
        $user->refresh();
        $this->assertNotNull($user->avatar);
        Storage::disk('public')->assertExists($user->avatar);
    }

    /**
     * Test avatar upload replaces old avatar.
     * @requires extension gd
     */
    public function test_avatar_upload_replaces_old_avatar(): void
    {
        if (!function_exists('imagecreatetruecolor')) {
            $this->markTestSkipped('GD extension is not installed.');
        }

        // Create user with existing avatar
        $oldImage = UploadedFile::fake()->image('old_avatar.jpg');
        $oldPath = $oldImage->store('avatars', 'public');
        
        $user = User::factory()->create(['avatar' => $oldPath]);

        // Upload new avatar
        $newImage = UploadedFile::fake()->image('new_avatar.jpg');
        $response = $this->actingAs($user)->post('/profile/avatar', [
            'avatar' => $newImage,
        ]);

        $response->assertRedirect();
        $user->refresh();

        // Old avatar should be deleted
        Storage::disk('public')->assertMissing($oldPath);
        // New avatar should exist
        Storage::disk('public')->assertExists($user->avatar);
    }

    /**
     * Test profile update validation fails with invalid data.
     */
    public function test_profile_update_validation_fails(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/profile/update', [
            'name' => '', // Required field empty
            'phone' => 'not-numeric', // Should be numeric
        ]);

        $response->assertSessionHasErrors(['name', 'phone']);
    }

    /**
     * Test password update validation fails with wrong current password.
     */
    public function test_password_update_fails_with_wrong_current_password(): void
    {
        $user = User::factory()->create([
            'password' => 'correctpassword',
        ]);

        $response = $this->actingAs($user)->post('/profile/password', [
            'current_password' => 'wrongpassword',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertSessionHasErrors('current_password');
    }

    /**
     * Test password update validation fails with mismatched confirmation.
     */
    public function test_password_update_fails_with_mismatched_confirmation(): void
    {
        $user = User::factory()->create([
            'password' => 'currentpassword',
        ]);

        $response = $this->actingAs($user)->post('/profile/password', [
            'current_password' => 'currentpassword',
            'password' => 'newpassword123',
            'password_confirmation' => 'differentpassword',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /**
     * Test avatar upload validation fails with non-image file.
     */
    public function test_avatar_upload_fails_with_non_image(): void
    {
        $user = User::factory()->create();
        $file = UploadedFile::fake()->create('document.pdf', 100);

        $response = $this->actingAs($user)->post('/profile/avatar', [
            'avatar' => $file,
        ]);

        $response->assertSessionHasErrors('avatar');
    }
}
