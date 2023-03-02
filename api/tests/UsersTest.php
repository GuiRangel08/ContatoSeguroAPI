<?php

namespace Tests;

use GuzzleHttp\Client;

use PHPUnit\Framework\TestCase;

class UsersTest extends TestCase
{
    public function testGetUsers()
    {
        $client = new Client();
        
        $response = $client->request('GET', 'http://localhost/api/users', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => '1b9552ff-5940-4f16-af96-97f248a1535f'
            ]
        ]);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->hasHeader('Content-Type'));
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertNotEmpty($response->getBody());
        $this->assertJson($response->getBody());
    }

    public function testPetUsers()
    {
        $client = new Client();
        
        $response = $client->request('POST', 'http://localhost/api/users', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => '1b9552ff-5940-4f16-af96-97f248a1535f'
            ]
        ]);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->hasHeader('Content-Type'));
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertNotEmpty($response->getBody());
        $this->assertJson($response->getBody());
    }
}
