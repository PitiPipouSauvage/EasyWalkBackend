<?php

class Medal
{
    private static Medal $_instance;

    public static function getInstance(): Medal {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function medalExists($medalId): bool {
        $stmt = databaseConnexion::getPdo()->prepare("SELECT * FROM MEDALS WHERE medalId = :medalId");
        $stmt->execute([":username" => $medalId]);
        return $stmt->rowCount() > 0;
    }

    public function grantMedal($username, $medalId): void {
        if (User::getInstance()->userExists($username) && $this->medalExists($medalId)) {
            $stmt = databaseConnexion::getPdo()->prepare("INSERT INTO GRANTMEDAL VALUES(:username, :medalId)");
            $stmt->execute([
                ":username" => $username,
                ":medalId" => $medalId
            ]);
        }
    }
}