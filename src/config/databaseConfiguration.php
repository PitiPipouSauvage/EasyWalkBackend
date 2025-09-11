<?php

class databaseConfiguration
{
    static private array $databaseConfiguration = array();

    public static function init(): void {
        self::$databaseConfiguration["hostname"] = "webinfo.iutmontp.univ-montp2.fr";
        self::$databaseConfiguration["dbName"] = "baertt";
        self::$databaseConfiguration["dbPort"] = 3316;
        self::$databaseConfiguration["login"] = "baertt";
        self::$databaseConfiguration["password"] = "100434215ha";
    }

    static public function getDatabaseConfiguration(): array {
        self::init();
        return self::$databaseConfiguration;
    }
}
