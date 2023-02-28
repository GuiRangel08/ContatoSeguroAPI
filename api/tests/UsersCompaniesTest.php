<?php

namespace Tests;

use GuzzleHttp\Client;

use PHPUnit\Framework\TestCase;

class UsersCompaniesTest extends TestCase
{
    public function testPostUsersCompanies()
    {
        $client = new Client();
        
        $response = $client->request('POST', 'http://api:3000/api/users_companies', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => '1b9552ff-5940-4f16-af96-97f248a1535f'
            ],
            'body' => json_encode([
                [
                    'user_id' => '1',
                    'company_id' => '021'
                ]
            ])
        ]);
        
        $this->assertEquals(200, $response->getStatusCode());
        // Verifica se o status code retornado pela rota é 200
        
        $responseData = json_decode($response->getBody(), true);
        $this->assertEquals('success', $responseData['status']);
        // Verifica se a chave "status" do corpo de resposta é "success"
        
        // Aqui você pode adicionar mais verificações de acordo com a resposta esperada
    }
}
