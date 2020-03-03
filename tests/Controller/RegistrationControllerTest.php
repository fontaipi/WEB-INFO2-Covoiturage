<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegister(){
        $client = static::createClient();
        $client->request("GET",'/register');
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }
}