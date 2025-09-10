<?php

class Utils
{
    public static function removeUser($username) {
        if (User::getInstance()->userExists($username)) {
            $pdo = databaseConnexion::getPdo();
            $pdo->beginTransaction();
            $pdo->prepare("DELETE FROM USERS WHERE username = ?")->execute([$username]);
            $pdo->commit();
        }
    }
}