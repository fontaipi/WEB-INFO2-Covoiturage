<?php

use App\Entity\Trajet;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        $this->user = new User();
    }

    public function testNewUser(): void
    {
        $this->assertInstanceOf(User::class, $this->user);
        $this->assertNull($this->user->getId());
    }

    public function testUserNom(): void
    {
        $this->user->setNom("martin");
        $this->assertEquals("martin", $this->user->getNom());
    }

    public function testUserPrenom(): void
    {
        $this->user->setPrenom("philippe");
        $this->assertEquals("philippe", $this->user->getPrenom());
    }

    public function testUserUsername(): void
    {
        $this->user->setUsername("philou38");
        $this->assertEquals("philou38", $this->user->getUsername());
    }

    public function testUserPassword(): void
    {
        $this->user->setPassword("azerty");
        $this->assertEquals("azerty", $this->user->getPassword());
    }

    public function testUserEmail(): void
    {
        $this->user->setEmail("azerty@mail.com");
        $this->assertEquals("azerty@mail.com", $this->user->getEmail());
    }

    public function testAddTrajetConducteur() : void
    {
        $trajet = new Trajet();
        $this->user->addConducteurTrajet($trajet);
        $this->assertContains($trajet, $this->user->getConducteurTrajets());
    }

    public function testAddTrajetPassager() : void
    {
        $trajet = new Trajet();
        $this->user->addPassagerTrajet($trajet);
        $this->assertContains($trajet, $this->user->getPassagerTrajets());
    }

    public function testRemoveTrajetConducteur():void
    {
        $trajet = new Trajet();
        $this->user->addConducteurTrajet($trajet);
        $this->user->removeConducteurTrajet($trajet);
        $this->assertNotContains($trajet, $this->user->getConducteurTrajets());
    }
}
