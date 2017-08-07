<?php
namespace Utnianos\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;
use Utnianos\Core\Usuario;
use Utnianos\Tests\TestCase;

class registerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testRegistroCorrecto()
    {
        $user = ['usuario'=> 'aUser', 'email' => 'aUser@example.com', 'password' => 'testPassword'];
        $response = $this->json('POST', '/api/registrar', $user );
        $response->assertStatus(200);
        $response->assertJsonStructure(['token']);
        $token = $response->json()['token'];

        $decodedToken = JWTAuth::decode(new Token($token));
        $this->assertEquals(1, $decodedToken['sub']);
    }

    public function testDeberiaFallarSiElUsuarioOElMailExiste() {
        $user = factory(Usuario::class)->create([
            'usuario' => 'aUser',
            'email' => 'aUser@example.com'
        ]);

        $response = $this->json('POST', '/api/registrar',
            ['usuario'=> $user->usuario,
             'email' => $user->email, 'password' => 'testPassword']);
        $response->assertStatus(422);
        $response->assertJsonStructure(['usuario', 'email']);
    }
}
