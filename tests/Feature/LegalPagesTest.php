<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LegalPagesTest extends TestCase
{
    public function test_privacy_policy_page_loads()
    {
        $response = $this->get(route('privacy'));
        $response->assertStatus(200);
        $response->assertSee('Privacy Policy');
    }

    public function test_terms_and_conditions_page_loads()
    {
        $response = $this->get(route('terms'));
        $response->assertStatus(200);
        $response->assertSee('Terms and Conditions');
    }

    public function test_disclaimer_page_loads()
    {
        $response = $this->get(route('disclaimer'));
        $response->assertStatus(200);
        $response->assertSee('Disclaimer');
    }
}
