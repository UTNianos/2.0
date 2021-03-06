<?php

namespace Tests\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ApiTestCase;

class AuthControllerTest extends ApiTestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testAuth() {
        $jsonResponse = $this->json('GET', '/auth/jwt/token',[], ['Authorization'=>"basic ".base64_encode('admin@admin.com:secret')]);
        // Check status and structure
        $jsonResponse
            ->assertStatus(200)
            ->assertJsonStructure(
                [ 'data' => [ 'jwt','tokenType','expiresIn' ]]
            );
    }
}
