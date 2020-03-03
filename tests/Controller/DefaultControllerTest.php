<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testHomepage(): void
    {
        $client = static::createClient();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertSelectorExists('a[href="/login"]');
        $this->assertSelectorExists('a[href="/register"]');

    }

    public function testHomepageuser(): void
    {
        $client = static::createClient([
            'PHP_AUTH_USER' => 'username',
            'PHP_AUTH_PW' => 'password'
        ]);

        $this->assertSelectorExists('a[href="/logout"]');

    }
}