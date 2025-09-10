<?php

use PHPUnit\Framework\TestCase;

require_once "src/models/User.php";
require_once "src/config/databaseConnexion.php";

class UserTest extends TestCase
{
    public function testCreateUser() {
        $user = User::getInstance();
        if (!$user->userExists("helloKitty")) {
            $user->createUser("helloKitty", "I love kittens");
        }
        $isUserCreated = $user->userExists("helloKitty");
        $this->assertTrue($isUserCreated);
    }
}