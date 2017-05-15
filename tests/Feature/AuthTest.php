<?php
namespace Utnianos\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;
use Utnianos\Core\Usuario;
use Utnianos\Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testGetToken()
    {
        $user = factory(Usuario::class)->create([
            'password' => 'testPassword',
        ]);

        $response = $this->json('POST', '/api/authenticate',
            ['email' => $user->email, 'password' => 'testPassword']);
        $response->assertJsonStructure(['token']);
        $token = $response->json()['token'];

        // el token deberia ser del usuario que se registro
        $decodedToken = JWTAuth::decode(new Token($token));
        $this->assertEquals($user->id, $decodedToken['sub']);
    }

    public function testNoToken() {
        $response = $this->json('GET', '/api/authenticate');
        $response->assertStatus(400);

    }

    public function testToken()
    {
        $user = factory(Usuario::class)->create([
            'password' => 'testPassword',
        ]);
        $token = JWTAuth::fromUser($user);
        $response = $this->json('GET', '/api/authenticate', [],
            ['Authorization' => 'Bearer '.$token]);
        $response->assertStatus(200);
    }
}
