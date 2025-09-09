<?php

class User
{
    private static User $_instance;

    public static function getInstance(): User {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct() {

    }

    public function verify($username, $password): bool {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = databaseConnexion::getPdo()->prepare("SELECT * FROM users WHERE username = :username AND password = :password", [
            ":username" => $username,
            ":password" => $hashedPassword
        ]);

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function createUser($username, $password): void {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = databaseConnexion::getPdo()->prepare("INSERT INTO users (username, password) VALUES (:username, :password)", [
            ":username" => $username,
            ":password" => $hashedPassword
        ]);

        $stmt->execute();
    }

    public function userExists($username): bool {
        $stmt = databaseConnexion::getPdo()->prepare("SELECT * FROM users WHERE username = :username", [":username" => $username]);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function addFriend($username, $friendUsername): void {
        if (self::userExists($username) && self::userExists($friendUsername)) {
            $stmt = databaseConnexion::getPdo()->prepare("INSERT INTO BEFRIENDS (username1, username2) VALUES (:username1, :username2)", [
                ":username1" => $username,
                ":username2" => $friendUsername
            ]);

            $stmt->execute();
        }
    }

    public function rateUser($username, $rating, $description, $rated): void {
        if (self::userExists($username) && self::userExists($rated)) {
            $stmt = databaseConnexion::getPdo()->prepare("INSERT INTO RATE VALUES(:username, :rating, :description, :rated)", [
                ":username" => $username,
                ":rated" => $rated,
                ":rating" => $rating,
                ":description" => $description
            ]);

            $stmt->execute();
        }
    }
}