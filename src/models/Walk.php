<?php

class Walk
{
    private static Walk $_instance;

    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new Walk();
        }
        return self::$_instance;
    }

    private function __construct() {}


    public function addWalk(string $username, $steps, $walkDate, $points, $distance) {
        if (User::getInstance()->userExists($username)) {
            $stmt = databaseConnexion::getPdo()->prepare("INSERT INTO WALKS (nbSteps, points, distance, walkDate, username) VALUES (:nbSteps, :points, :distance, :walkDate, :username)", [
                'nbSteps' => $steps,
                'points' => $points,
                'distance' => $distance,
                'walkDate' => date($walkDate),
                'username' => $username
            ]);

            $stmt->execute();
        }
    }
}