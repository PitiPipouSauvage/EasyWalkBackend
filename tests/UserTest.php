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
        Utils::removeUser("helloKitty");
    }

    public function testLoginUser() {
        $user = User::getInstance();
        if (!$user->userExists("helloKitty")) {
            $user->createUser("helloKitty", "I love kittens");
        }
        $this->assertTrue($user->verify("helloKitty", "I love kittens"));
        Utils::removeUser("helloKitty");
    }

    public function testFriends() {
        $user = User::getInstance();
        if (!$user->userExists("helloKitty")) {
            $user->createUser("helloKitty", "I love kittens");
        }
        if (!$user->userExists("dora")) {
            $user->createUser("dora", "hola soy dora");
        }

        $user->addFriend("helloKitty", "dora");
        $this->assertEquals(["dora"], $user->getFriends("helloKitty"));
        $this->assertEquals(["helloKitty"], $user->getFriends("dora"));
    }
}