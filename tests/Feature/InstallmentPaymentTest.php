<?php

namespace Tests\Feature;

use App\Models\InstallmentPlan;
use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InstallmentPaymentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
    }

    public function test_user_can_create_installment_plan()
    {
        $user = User::factory()->create([
             'role_id' => \App\Models\Role::where('slug', 'user')->first()->id,
        ]);
        $property = Property::factory()->create([
            'price' => 120000,
            'slug' => 'test-property',
        ]);

        $response = $this->actingAs($user)
            ->post(route('checkout.installment.create', $property->slug), [
                'duration' => 12,
            ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('installment_plans', [
            'user_id' => $user->id,
            'property_id' => $property->id,
            'total_amount' => 120000,
            'duration_months' => 12,
        ]);

        $this->assertDatabaseCount('installments', 12);
    }

    public function test_user_can_view_installment_plans()
    {
        $user = User::factory()->create([
             'role_id' => \App\Models\Role::where('slug', 'user')->first()->id,
        ]);
        $property = Property::factory()->create();

        InstallmentPlan::create([
            'user_id' => $user->id,
            'property_id' => $property->id,
            'total_amount' => 100000,
            'balance_due' => 100000,
            'duration_months' => 12,
            'start_date' => now(),
            'end_date' => now()->addYear(),
            'status' => 'active',
        ]);

        $response = $this->actingAs($user)->get(route('installments.index'));
        $response->assertStatus(200);
        $response->assertSee($property->title);
    }

    public function test_admin_can_view_installment_plans()
    {
        $admin = User::factory()->create([
            'role_id' => \App\Models\Role::where('slug', 'admin')->first()->id,
        ]);

        $user = User::factory()->create([
             'role_id' => \App\Models\Role::where('slug', 'user')->first()->id,
        ]);
        $property = Property::factory()->create();

        InstallmentPlan::create([
            'user_id' => $user->id,
            'property_id' => $property->id,
            'total_amount' => 100000,
            'balance_due' => 100000,
            'duration_months' => 12,
            'start_date' => now(),
            'end_date' => now()->addYear(),
            'status' => 'active',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.installments.index'));
        $response->assertStatus(200);
        // $response->dump(); // Debugging if needed
        $response->assertSee($property->title);
        $response->assertSee($user->name);
    }
}
