<?php
namespace Utnianos\Tests\Feature;

use Utnianos\Tests\TestCase;

class ProvidersTest extends TestCase
{
    public function testElArrayDeProvidersEstaBienFormado() {
        $response = $this->json('get', 'api/login/providers');
        $response->assertStatus(200)
            ->assertJsonStructure(['*'=>['name', 'client', 'url','redirect','scope']]);
    }
}