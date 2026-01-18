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
}
