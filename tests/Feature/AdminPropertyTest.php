<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminPropertyTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Create Admin Role and Permission
        $role = Role::create(['name' => 'Admin', 'slug' => 'admin']);
        $permission = Permission::create(['name' => 'Manage Properties', 'slug' => 'manage_properties']);
        $role->permissions()->attach($permission);
        $role->permissions()->create(['name' => 'View Dashboard', 'slug' => 'view_dashboard']);

        // Create Admin User
        $this->adminUser = User::factory()->create(['role_id' => $role->id]);
    }

    public function test_admin_can_view_property_list()
    {
        Property::factory()->count(3)->create();

        $response = $this->actingAs($this->adminUser)
                         ->get(route('admin.properties.index'));

        $response->assertStatus(200);
        $response->assertViewHas('properties');
    }

    public function test_admin_can_create_property()
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('property.jpg');

        $response = $this->actingAs($this->adminUser)
                         ->post(route('admin.properties.store'), [
                             'title' => 'New Property',
                             'description' => 'Great location',
                             'location' => 'Lagos',
                             'price' => 5000000,
                             'type' => 'land',
                             'status' => 'available',
                             'features' => 'Water, Light',
                             'images' => [$file],
                             'is_featured' => 1,
                         ]);

        $response->assertRedirect(route('admin.properties.index'));
        $this->assertDatabaseHas('properties', ['title' => 'New Property']);

        // Assert file exists
        $property = Property::where('title', 'New Property')->first();
        $this->assertNotEmpty($property->images);
        // Storage::disk('public')->assertExists(str_replace('/storage/', '', $property->images[0]));
    }

    public function test_admin_can_update_property()
    {
        $property = Property::factory()->create();

        $response = $this->actingAs($this->adminUser)
                         ->put(route('admin.properties.update', $property->id), [
                             'title' => 'Updated Property',
                             'description' => 'Updated description',
                             'location' => 'Abuja',
                             'price' => 6000000,
                             'type' => 'house',
                             'status' => 'sold_out',
                             'features' => 'Security',
                         ]);

        $response->assertRedirect(route('admin.properties.index'));
        $this->assertDatabaseHas('properties', ['id' => $property->id, 'title' => 'Updated Property']);
    }

    public function test_admin_can_delete_property()
    {
        $property = Property::factory()->create();

        $response = $this->actingAs($this->adminUser)
                         ->delete(route('admin.properties.destroy', $property->id));

        $response->assertRedirect(route('admin.properties.index'));
        $this->assertDatabaseMissing('properties', ['id' => $property->id]);
    }
}
