<?php

namespace Tests\Feature;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_loads_and_passes_featured_properties_to_view()
    {
        Property::truncate();

        // Create featured properties
        $properties = Property::factory()->count(3)->sequence(
            ['title' => 'Featured Property 1', 'is_featured' => true],
            ['title' => 'Featured Property 2', 'is_featured' => true],
            ['title' => 'Featured Property 3', 'is_featured' => true],
        )->create();

        // Create non-featured property
        $nonFeatured = Property::factory()->create(['title' => 'Hidden Property', 'is_featured' => false]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);

        $response->assertViewHas('featuredProperties', function ($viewProperties) use ($properties) {
             return $viewProperties->count() === 3
                && $viewProperties->pluck('id')->contains($properties->first()->id);
        });
    }
}
