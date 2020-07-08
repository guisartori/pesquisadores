<?php
/*
 * @Author Fabio Rocha
 */

namespace App\Lib;

use PDO;
use PDOException;
use Exception;

class DB
{
    private $error;
    private $host;
    private $name;
    private $username;
    private $password;
    private $driver;
    private $pdo;

    public function __construct()
    {
        $oConfigDb = $_SESSION['oConfig']->getConfig()->db;

        // $this->host         = "sql106.epizy.com";
        // $this->host         = "sql10.freemysqlhosting.net";
        $this->host         = "nnmeqdrilkem9ked.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
        // $this->host         = "127.0.0.1";
        // $this->name         = "epiz_26207655_pesquisadores";
        // $this->name         = "sql10351862";
        $this->name         = "t5ps8xq0nu4md92p";
        // $this->name         = "projeto_pesquisadores";
        // $this->username     = "epiz_26207655";
        // $this->username     = "sql10351862";
        $this->username     = "jktbliklov0wtc1x";
        // $this->username     = "root";
        // $this->password    = "pr0j3t05";
        // $this->password    = "qqvH5ZyaGB";
        $this->password    = "mvrknjivd3xd94ym";
        // $this->password    = "";

        $this->driver       = (!empty($oConfigDb->driver))      ? $oConfigDb->driver    : "";

        $this->pdo = $this->connect();
    }

    protected function connect()
    {

        $pdoConfig  = $this->driver . ":" . "host=" . $this->host . ";";
        $pdoConfig .= "dbname=" . $this->name . ";";

        try {
            return  new PDO($pdoConfig, $this->username, $this->password);
        } catch (PDOException $e) {
            throw new Exception($e);
        }
    }

    public function query($sql, $data_array = null)
    {

        $query  = $this->pdo->prepare($sql);
        $exec   = $query->execute($data_array);

        if ($exec) {
            return $query;
        } else {
            $error       = $query->errorInfo();
            $this->error = $error[2];

            throw new \Exception($this->error);
        }
    }

    public function insert($table, $cols, $values)
    {

        $stmt = "INSERT INTO $table ( $cols ) VALUES ( $values ) ";

        $insert = $this->query($stmt);

        if ($insert) {

            if (
                method_exists($this->pdo, 'lastInsertId')
                && $this->pdo->lastInsertId()
            ) {
                $this->last_id = $this->pdo->lastInsertId();
            }

            // Retorna a consulta
            return $insert;
        }

        return;
    }

    public function update($table, $values, $where)
    {

        $stmt = "UPDATE $table SET $values WHERE $where";

        $insert = $this->query($stmt);

        return;
    }

    public function delete($table, $where)
    {
        return $this->query("DELETE FROM $table WHERE $where");
    }
}
