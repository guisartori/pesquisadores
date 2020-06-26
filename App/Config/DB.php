<?php

namespace App\Config;

use PDO;
use PDOException;

class DB{

    private static $host = "127.0.0.1";
    private static $dbName = "projeto_pesquisadores";
    private static $user = "root";
    private static $password = "";

    static function get() {
        try {
            return new PDO("mysql:host=localhost; dbname=projeto_pesquisadores", "root", "");
            //    self::$instance = new PDO('mysql:host='.$host.';dbname='.$dbName, "root", $password);
        } catch(PDOException $e) {
            // TODO: Handle this properly
            throw $e;
        }
    }
}