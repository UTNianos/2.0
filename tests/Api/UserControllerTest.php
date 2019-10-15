<?php

namespace Tests\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ApiTestCase;
use App\Models\User;

class UserTest extends ApiTestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }
    public function testGetAll()
    {
        $jsonResponse = $this->actingAsAdmin()->json('GET', '/users');

        // Check status and structure
        $jsonResponse
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        [
                            'id',
                            'name',
                            'email',
                            'avatar'
                        ],
                    ],
                ]
            );
    }

    public function testPost()
    {
        $testUser = factory(User::class)->make()->getAttributes();

        $jsonResponse = $this->actingAsAdmin()->json('POST', '/users', $testUser);

        unset($testUser['password']);

        // Check status, structure and data
        $jsonResponse
            ->assertStatus(201)
            ->assertJsonStructure(
                [
                    'data' =>
                        [
                            'avatar',
                            'name',
                            'email',
                            'id',
                        ]
                ]
            );

        // Check password is hidden
        $response = $jsonResponse->decodeResponseJson();
        $this->assertNotContains('password', $response['data']);
    }
}
