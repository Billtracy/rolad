<?php

namespace Tests\Feature;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertyShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_property_details_page_loads_with_correct_data()
    {
        $property = Property::factory()->create([
            'title' => 'Test Property',
            'description' => 'This is a test description.',
            'price' => 5000000,
            'features' => ['Water', 'Light'],
        ]);

        $response = $this->get(route('properties.show', $property->slug));

        $response->assertStatus(200);
        $response->assertSee('Test Property');
        $response->assertSee('This is a test description.');
        $response->assertSee(number_format(5000000 / 1000000, 2) . 'M');
        $response->assertSee('Water');
        $response->assertSee('Light');
    }

    public function test_property_details_page_returns_404_for_invalid_slug()
    {
        $response = $this->get(route('properties.show', 'invalid-slug'));

        $response->assertStatus(404);
    }
}
