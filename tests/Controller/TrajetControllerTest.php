<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrajetControllerTest extends WebTestCase
{
    public function testForbiddenToAnonymous(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/trajet/new');
        $this->assertNotEquals(200, $client->getResponse()->getStatusCode());
        $this->assertResponseRedirects('/login');
    }

    public function testAllowedToUser(): void
    {
        $client = static::createClient(
            [],
            [
                'PHP_AUTH_USER' => 'admin',
                'PHP_AUTH_PW' => '123456',
            ]
        );
        $crawler = $client->request('GET', '/trajet/new');
        $this->assertNotEquals(200, $client->getResponse()->getStatusCode());
    }
}