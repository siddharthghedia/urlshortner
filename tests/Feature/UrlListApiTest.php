<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlListApiTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_url_list_api_give_list_of_public_urls()
    {
        $response = $this->getJson('api/url-list');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'current_page',
                    'data',
                    'first_page_url',
                    'from',
                    'next_page_url',
                    'path',
                    'per_page',
                    'prev_page_url',
                    'to'
                ]
            ]);
    }
}
