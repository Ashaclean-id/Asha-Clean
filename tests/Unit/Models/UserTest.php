<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user has correct fillable attributes.
     */
    public function test_has_correct_fillable_attributes(): void
    {
        $user = new User();
        $fillable = $user->getFillable();

        $this->assertContains('name', $fillable);
        $this->assertContains('email', $fillable);
        $this->assertContains('password', $fillable);
        $this->assertContains('role', $fillable);
        $this->assertContains('phone', $fillable);
        $this->assertContains('address', $fillable);
        $this->assertContains('avatar', $fillable);
    }

    /**
     * Test user has correct hidden attributes.
     */
    public function test_has_correct_hidden_attributes(): void
    {
        $user = new User();
        $hidden = $user->getHidden();

        $this->assertContains('password', $hidden);
        $this->assertContains('remember_token', $hidden);
    }

    /**
     * Test password is automatically hashed.
     */
    public function test_password_is_automatically_hashed(): void
    {
        $user = User::factory()->create([
            'password' => 'plainpassword',
        ]);

        $this->assertTrue(Hash::check('plainpassword', $user->password));
        $this->assertNotEquals('plainpassword', $user->password);
    }

    /**
     * Test email_verified_at is cast to datetime.
     */
    public function test_email_verified_at_is_cast_to_datetime(): void
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $user->email_verified_at);
    }

    /**
     * Test factory creates valid user.
     */
    public function test_factory_creates_valid_user(): void
    {
        $user = User::factory()->create();

        $this->assertNotNull($user->id);
        $this->assertNotNull($user->name);
        $this->assertNotNull($user->email);
        $this->assertNotNull($user->password);
    }

    /**
     * Test factory unverified state.
     */
    public function test_factory_unverified_state(): void
    {
        $user = User::factory()->unverified()->create();

        $this->assertNull($user->email_verified_at);
    }

    /**
     * Test user can be created with role.
     */
    public function test_can_create_user_with_role(): void
    {
        $user = User::factory()->create(['role' => 'admin']);

        $this->assertEquals('admin', $user->role);
    }

    /**
     * Test user can be created with phone and address.
     */
    public function test_can_create_user_with_profile_details(): void
    {
        $user = User::factory()->create([
            'phone' => '081234567890',
            'address' => 'Jl. Test No. 123',
        ]);

        $this->assertEquals('081234567890', $user->phone);
        $this->assertEquals('Jl. Test No. 123', $user->address);
    }

    /**
     * Test user email must be unique.
     */
    public function test_email_is_unique(): void
    {
        User::factory()->create(['email' => 'test@example.com']);

        $this->expectException(\Illuminate\Database\QueryException::class);
        User::factory()->create(['email' => 'test@example.com']);
    }
}
