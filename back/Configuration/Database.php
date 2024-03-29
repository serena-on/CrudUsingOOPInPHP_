<?php

namespace Configuration;

use Class\Exception\FailedToLoginException;

class Database
{
    private $host = 'localhost';
    private $dataBaseName = 'AGRI_DIGITAL';
    private $dataBaseUser = 'root';
    private $dataBasePassword = 'root';
    private $dsn;
    private $connection;

    public function __construct()   
    {
        try {
            $this->dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dataBaseName;
            $this->connection = new \PDO($this->dsn, $this->dataBaseUser, $this->dataBasePassword);
            $this->connection -> exec("SET NAMES utf8");
            $this->connection -> setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (FailedToLoginException $e) {
            echo "Database could not be connected: " . $e->getMessage();
        }
    }
    public function getConnection()
    {
        return $this->connection;
    }
}
