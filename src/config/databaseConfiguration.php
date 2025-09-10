<?php

class databaseConfiguration
{
    static private array $databaseConfiguration = array();

    public static function init(): void {
        self::$databaseConfiguration["hostname"] = getenv("DB_HOSTNAME");
        self::$databaseConfiguration["dbName"] = getenv("DB_NAME");
        self::$databaseConfiguration["dbPort"] = getenv("DB_PORT");
        self::$databaseConfiguration["login"] = getenv("DB_LOGIN");
        self::$databaseConfiguration["password"] = getenv("DB_PASSWORD");

        var_dump(self::$databaseConfiguration);
    }

    static public function getDatabaseConfiguration(): array {
        self::init();
        return self::$databaseConfiguration;
    }
}
