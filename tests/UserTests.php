<?php

use PHPUnit\Framework\TestCase;

class UserTests extends TestCase
{
    public function testCreateUser() {
        $user = User::getInstance();
        $user->createUser("helloKitty", "I love kittens");
        $isUserCreated = $user->userExists("helloKitty");
        $this->assertTrue($isUserCreated);
    }
}