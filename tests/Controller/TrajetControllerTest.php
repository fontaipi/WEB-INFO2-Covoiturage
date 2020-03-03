<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrajetControllerTest extends WebTestCase
{
    public function testNouveauTrajet(): void
    {
        $client = static::createClient(
            [],
            [
                'PHP_AUTH_USER' => 'admin',
                'PHP_AUTH_PW' => '123456',
            ]
        );
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorNotExists('a[href="/login"]');
        $this->assertSelectorNotExists('a[href="/register"]');
        $this->assertSelectorExists('a[href="/logout"]');
        $this->assertSelectorExists('a[href="/trajet/new"]');

        $client->clickLink('Nouveau trajet');

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
}
