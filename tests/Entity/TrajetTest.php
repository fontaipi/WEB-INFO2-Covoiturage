<?php

use App\Entity\Lieu;
use App\Entity\Trajet;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

final class TrajetTest extends TestCase
{
    protected $trajet;

    public function setUp(): void
    {
        $this->trajet = new Trajet();
    }

    public function testTrajet(): void
    {
        $this->assertInstanceOf(Trajet::class, $this->trajet);
        $this->assertNull($this->trajet->getId());
    }

    public function testTrajetPlaces(): void
    {
        $this->trajet->setPlaces(8);
        $this->assertEquals(8, $this->trajet->getPlaces());
    }

    public function testTrajetDateTime(): void
    {
        $date = new DateTime();
        $this->trajet->setDateTime($date);
        $this->assertEquals($date, $this->trajet->getDateTime());
    }

    public function testTrajetLieuDepart(): void
    {
        $lieu = new Lieu();
        $this->trajet->setLieuDepart($lieu);
        $lieu->addDepartTrajet($this->trajet);
        $this->assertEquals($lieu, $this->trajet->getLieuDepart());
        $this->assertContains($this->trajet, $lieu->getDepartTrajet());
    }

    public function testTrajetLieuArrive(): void
    {
        $lieu = new Lieu();
        $this->trajet->setLieuArrive($lieu);
        $lieu->addArriveTrajet($this->trajet);
        $this->assertEquals($lieu, $this->trajet->getLieuArrive());
        $this->assertContains($this->trajet, $lieu->getArriveTrajet());
    }

    public function testTrajetConducteur() : void
    {
        $user = new User();
        $this->trajet->setConducteur($user);
        $user->addConducteurTrajet($this->trajet);
        $this->assertEquals($user, $this->trajet->getConducteur());
        $this->assertContains($this->trajet, $user->getConducteurTrajets());
    }

    public function testTrajetPassager() : void
    {
        $user = new User();
        $this->trajet->addPassager($user);
        $user->addPassagerTrajet($this->trajet);
        $this->assertContains($user, $this->trajet->getPassager());
        $this->assertContains($this->trajet, $user->getPassagerTrajets());
    }

    public function testRemovePassagerTrajet() : void
    {
        $user = new User();
        $this->trajet->addPassager($user);
        $this->trajet->removePassager($user);
        $this->assertNotContains($user, $this->trajet->getPassager());
    }

}
