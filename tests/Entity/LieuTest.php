<?php

use App\Entity\User;
use PHPUnit\Framework\TestCase;

final class LieuTest extends TestCase
{
    protected $lieu;

    public function setUp(): void
    {
        $this->lieu = new Lieu();
    }

    public function testLieu(): void
    {
        $this->assertInstanceOf(Lieu::class, $this->lieu);
        $this->assertNull($this->lieu->getId());
    }

    public function testUserNom(): void
    {
        $this->user->setNom("martin");
        $this->assertEquals("martin", $this->user->getNom());
    }

}
