<?php

use App\Entity\User;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    public function testNewUser(): void {
        $user = new User();
        $this->assertInstanceOf(User::class, $user);
        $this->assertNull($user->getId());
    }

    public  function testUserNom(): void {
        $user = new User();
        $user->setNom("martin");
        $this->assertEquals("martin", $user->getNom());
    }

    public  function testUserPrenom(): void {
        $user = new User();
        $user->setPrenom("philippe");
        $this->assertEquals("philippe", $user->getPrenom());
    }
}
