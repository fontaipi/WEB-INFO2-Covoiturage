<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrajetControllerTest extends WebTestCase
{
    public function testForbiddenToAnonymous(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
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

    public function testNouveauTrajet(): void
    {
        $client = static::createClient();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/trajet/new');

        $form = $crawler->filter('.form-trajet')->form();

        $form['trajet[places]']->setValue(1);
        $form['trajet[datetime][date][month]']->select(1);
        $form['trajet[datetime][date][day]']->select(1);
        $form['trajet[datetime][date][year]']->select(2020);
        $form['trajet[datetime][time][hour]']->select(1);
        $form['trajet[datetime][time][minute]']->select(1);
        $form['trajet[lieudepart]']->select(1);
        $form['trajet[lieuarrive]']->select(2);
        $form['trajet[conducteur]']->select(3);
        $form['trajet[passager]']->select(3);

        $client->submitForm($form);

        $this->assertResponseRedirects('http://localhost/trajet');
    }

    public function testAllowedToUserConsultListTrajet():void{
        $client = static::createClient(
            [],
            [
                'PHP_AUTH_USER' => 'admin',
                'PHP_AUTH_PW' => '123456',
            ]
        );
        $crawler = $client->request('GET', '/trajet/list');
        $this->assertNotEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testNotAllowedToUserConsultListTrajet():void{ // test where user is not logged (invalid credentials here)
        $client = static::createClient(
            [],
            [
                'PHP_AUTH_USER' => 'admin',
                'PHP_AUTH_PW' => 'falsepassword',
            ]
        );
        $crawler = $client->request('GET', '/trajet/list');
        $this->assertNotEquals(401, $client->getResponse()->getStatusCode());
    }

    //scenario test creation de trajet
    //poster le form de submit trajet
    //aller sur trajet/list
    //verifier que le trajet existe (meme date)
    //verifier que le conducteur est l'utilisateur courant
}