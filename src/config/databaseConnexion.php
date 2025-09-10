<?php
require_once "databaseConfiguration.php";

class databaseConnexion {
    private static ?databaseConnexion $instance = null;
    private PDO $pdo;

    private function __construct() {
        $config = databaseConfiguration::getDatabaseConfiguration();
        $pdo = new PDO("mysql:host=$config[hostname];port=$config[dbPort];dbname=$config[dbName]",
            $config["login"], $config["password"], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $this->pdo = $pdo;
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getPdo(): PDO {
        return databaseConnexion::getInstance()->pdo;
    }

    private static function getInstance(): databaseConnexion {
        if (is_null(databaseConnexion::$instance)) databaseConnexion::$instance = new databaseConnexion();
        return databaseConnexion::$instance;
    }
}

