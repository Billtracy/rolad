<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    // use RefreshDatabase; // Commented out to avoid wiping the seeded database if using it, but better to use it and seed in test.
    // However, since I just seeded the DB, I might want to test against it or use a separate test DB.
    // Standard practice is RefreshDatabase.

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
    }

    public function test_guest_cannot_access_admin_dashboard()
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    public function test_regular_user_cannot_access_admin_dashboard()
    {
        $user = User::factory()->create(['role_id' => Role::where('slug', 'user')->first()->id]);

        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(403);
    }

    public function test_super_admin_can_access_admin_dashboard()
    {
        $user = User::factory()->create(['role_id' => Role::where('slug', 'super-admin')->first()->id]);

        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(200);
    }

    public function test_admin_can_access_role_management()
    {
        $user = User::factory()->create(['role_id' => Role::where('slug', 'admin')->first()->id]);

        $response = $this->actingAs($user)->get('/admin/roles');
        $response->assertStatus(200);
    }
}
