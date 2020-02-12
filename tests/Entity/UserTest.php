<?php

use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    public function testNewUser(): void {
        $this->assertInstanceOf(User::class, new User());
    }
}
