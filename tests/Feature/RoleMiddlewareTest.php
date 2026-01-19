<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test guest is redirected to login for protected admin routes.
     */
    public function test_guest_is_redirected_to_login_for_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login');
    }

    /**
     * Test user with wrong role gets 403 on admin dashboard.
     */
    public function test_wrong_role_gets_403_on_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    /**
     * Test admin can access admin dashboard.
     */
    public function test_admin_can_access_admin_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    /**
     * Test user cannot access admin services.
     */
    public function test_user_cannot_access_admin_services(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/services');

        $response->assertStatus(403);
    }

    /**
     * Test guest is redirected to login for admin services.
     */
    public function test_guest_is_redirected_to_login_for_admin_services(): void
    {
        $response = $this->get('/admin/services');

        $response->assertRedirect('/login');
    }

    /**
     * Test admin can access admin services.
     */
    public function test_admin_can_access_admin_services(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/services');

        $response->assertStatus(200);
    }
}
