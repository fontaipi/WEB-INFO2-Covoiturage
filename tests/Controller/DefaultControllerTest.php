<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testHomepage(): void
    {
        $client = static::createClient();
        $client->request('GET','/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorExists('a[href="/login"]');
        $this->assertSelectorExists('a[href="/register"]');

    }

    public function testHomepageuser(): void
    {
        $client = static::createClient([],[
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => '123456'
        ]);
        $crawler = $client->request('GET','/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorExists('a[href="/logout"]');

    }
}
