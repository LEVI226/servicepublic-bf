<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads(): void
    {
        $response = $this->get(route('home'));
        $response->assertStatus(200);
    }

    public function test_search_page_loads_with_query(): void
    {
        $response = $this->get(route('recherche', ['q' => 'passeport']));
        $response->assertStatus(200);
        $response->assertViewIs('pages.recherche.index');
        $response->assertSee('passeport');
    }
}
