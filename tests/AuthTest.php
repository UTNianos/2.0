<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Utnianos\Core\Usuario;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    private $user;

    public function setUp()
    {

        parent::setUp();
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->user = factory(Usuario::class)->create([
            'password' => 'testPassword',
        ]);
        $response = $this->json('POST', '/api/authenticate',
            ['email' => $this->user->email, 'password' => 'testPassword']);
        $response->assertJsonStructure(['token']);
        $token = $response->json()['token'];

        // el token deberia ser del usuario que se registro
        $decodedToken = \Tymon\JWTAuth\Facades\JWTAuth::decode(new \Tymon\JWTAuth\Token($token));
        $this->assertEquals($this->user->id, $decodedToken['sub']);
    }
}
