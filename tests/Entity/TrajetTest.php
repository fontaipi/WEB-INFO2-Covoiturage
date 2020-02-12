<?php

use App\Entity\Trajet;
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

}
