<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CreateUrlApiTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_shorten_api_save_url_record(): void
    {
        $data = [
            'long_url' => $this->faker->url,
            'private' => 0
        ];

        $response = $this->postJson('api/shorten', $data);
        
        $response->assertStatus(200)
            ->assertExactJson([
                'success' => true,
                'message' => 'Url has been successfully shorten.',
                'data' => [
                    'id' => $response['data']['id'],
                    "long_url" => $response['data']['long_url'],
                    "short_url" => $response['data']['short_url'],
                    "private" => $response['data']['private'],
                    "created_at" => $response['data']['created_at'],
                    "updated_at" => $response['data']['updated_at'],
                ],
            ]);

        $this->assertDatabaseCount('urls', 1);
    }

    public function test_shorten_api_required_long_url_field()
    {
        $data = [
            'private' => 0
        ];

        $response = $this->postJson('api/shorten', $data);
        
        $response->assertStatus(422)
            ->assertExactJson([
                'success' => false,
                'errors' => [
                    'long_url' => [
                        'The long url field is required.'
                    ]
                ]
            ]);
    }

    public function test_shorten_api_store_default_public_url()
    {
        $data = [
            'long_url' => $this->faker->url,
        ];

        $response = $this->postJson('api/shorten', $data);

        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->where('data.private', 0)
                 ->etc()
        );
    }
}
