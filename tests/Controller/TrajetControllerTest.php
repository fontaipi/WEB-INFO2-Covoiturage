<?php


namespace App\Tests\Controller;


use PHPUnit\Framework\TestCase;

class TrajetControllerTest extends TestCase
{
    public function testNouveauTrajet(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}