<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LieuControllerTest extends WebTestCase
{
    public function testAllowedToUser(): void
    {
        $client = static::createClient(
            [],
            [
                'PHP_AUTH_USER' => 'admin',
                'PHP_AUTH_PW' => '123456',
            ]
        );
        $crawler = $client->request('GET', '/lieu/new');
        $this->assertNotEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testAllowedToUserLieuList(): void
    {
        $client = static::createClient(
            [],
            [
                'PHP_AUTH_USER' => 'admin',
                'PHP_AUTH_PW' => '123456',
            ]
        );
        $crawler = $client->request('GET', '/lieu/');
        $this->assertNotEquals(200, $client->getResponse()->getStatusCode());
    }

}