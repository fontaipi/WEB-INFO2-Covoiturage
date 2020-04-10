<?php

use App\Entity\Lieu;
use App\Entity\Trajet;
use PHPUnit\Framework\TestCase;

final class LieuTest extends TestCase
{
    protected $lieu;
    protected $trajet;

    public function setUp(): void
    {
        $this->lieu = new Lieu();
        $this->trajet = new Trajet();
    }

    public function testLieu(): void
    {
        $this->assertInstanceOf(Lieu::class, $this->lieu);
        $this->assertNull($this->lieu->getId());
    }

    public function testLieuNom(): void
    {
        $this->lieu->setNom("Alsace Lorraine");
        $this->assertEquals("Alsace Lorraine", $this->lieu->getNom());
    }

    public function testLieuLatitude(): void
    {
        $this->lieu->setLatitude(0.01);
        $this->assertEquals(0.01, $this->lieu->getLatitude());
    }

    public function testLieuLongitude(): void
    {
        $this->lieu->setLongitude(15.5);
        $this->assertEquals(15.5, $this->lieu->getLongitude());
    }

    public function testDepartTrajet() : void
    {
        $this->lieu->addDepartTrajet($this->trajet);
        $this->assertContains($this->trajet, $this->lieu->getDeparttrajet());
        $this->lieu->removeDepartTrajet($this->trajet);
        $this->assertNotContains($this->trajet, $this->lieu->getDeparttrajet());
    }

    public function testArriveTrajet() : void
    {
        $this->lieu->addArriveTrajet($this->trajet);
        $this->assertContains($this->trajet, $this->lieu->getArriveTrajet());
        $this->lieu->removeArriveTrajet($this->trajet);
        $this->assertNotContains($this->trajet, $this->lieu->getArriveTrajet());
    }

    public function testAddLieuToTrajet() : void
    {
        $this->lieu->addArriveTrajet($this->trajet);
        $this->assertEquals($this->lieu, $this->trajet->getLieuArrive());
        $this->lieu->addDepartTrajet($this->trajet);
        $this->assertEquals($this->lieu, $this->trajet->getLieuDepart());
    }

}
