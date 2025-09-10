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
        $stmt = databaseConnexion::getPdo()->prepare("SELECT * FROM USERS WHERE username = :username");

         $stmt->execute([":username" => $username,]);

        return password_verify($password, $stmt->fetchColumn("password"));
    }

    public function createUser($username, $password): void {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = databaseConnexion::getPdo()->prepare("INSERT INTO USERS (username, password) VALUES (:username, :password)");

        $stmt->execute([
            ":username" => $username,
            ":password" => $hashedPassword
        ]);
    }

    public function userExists($username): bool {
        $stmt = databaseConnexion::getPdo()->prepare("SELECT * FROM USERS WHERE username = :username");
        $stmt->execute([":username" => $username]);
        return $stmt->rowCount() > 0;
    }

    public function addFriend($username, $friendUsername): void {
        if (self::userExists($username) && self::userExists($friendUsername)) {
            $stmt = databaseConnexion::getPdo()->prepare("INSERT INTO BEFRIENDS (username1, username2) VALUES (:username1, :username2)");

            $stmt->execute([
                ":username1" => $username,
                ":username2" => $friendUsername
            ]);
        }
    }

    public function rateUser($username, $rating, $description, $rated): void {
        if (self::userExists($username) && self::userExists($rated)) {
            $stmt = databaseConnexion::getPdo()->prepare("INSERT INTO RATE VALUES(:username, :rating, :description, :rated)");

            $stmt->execute([
                ":username" => $username,
                ":rated" => $rated,
                ":rating" => $rating,
                ":description" => $description
            ]);
        }
    }

    public function all() {
        $stmt = databaseConnexion::getPdo()->query("SELECT * FROM USERS");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get($username) {
        $stmt = databaseConnexion::getPdo()->query("SELECT username, nbSteps, nbStepsWithFriends, points FROM USERS WHERE username = :username");
        $stmt->execute(["username" => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getFriends($username) {
        if (self::userExists($username)) {
            $stmt = databaseConnexion::getPdo()->prepare("SELECT * FROM BEFRIENDS WHERE username1 = :username");
            $stmt->execute(["username" => $username]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }
}