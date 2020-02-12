<?php

use App\Entity\Lieu;
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

}
