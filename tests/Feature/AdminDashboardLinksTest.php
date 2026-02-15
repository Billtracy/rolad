<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminDashboardLinksTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);

        $this->admin = User::factory()->create([
            'role_id' => Role::where('slug', 'admin')->first()->id,
        ]);
    }

    public function test_admin_can_access_properties_page()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.properties.index'));
        $response->assertStatus(200);
        $response->assertSee('Property Management');
    }

    public function test_admin_can_access_users_page()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.users.index'));
        $response->assertStatus(200);
        $response->assertSee('User Management');
    }

    public function test_admin_can_access_transactions_page()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.transactions.index'));
        $response->assertStatus(200);
        $response->assertSee('Transaction History');
    }

    public function test_admin_can_access_blogs_page()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.blogs.index'));
        $response->assertStatus(200);
        $response->assertSee('Blog Posts');
    }

    public function test_admin_can_access_settings_page()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.settings.index'));
        $response->assertStatus(200);
        $response->assertSee('Application Settings');
    }
}
