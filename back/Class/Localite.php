<?php

namespace Class;

use Configuration\Database;


class Localite
{
    private $dataBaseTable = "localite";

    private $connection ;

    private string $CodLoca;
    private string $LibLoca;


    public function __construct(Database $connectionDataBase)
    {
        $this->connection = $connectionDataBase->getConnection();
    }

    public function getAllLocalites() {
        $sql = "SELECT * FROM " . $this->dataBaseTable;
        $query = $this->connection->prepare($sql);
        $query->fetchAll(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query;
    }
    public function getLocalites(string $CodLocaIn) {
        $this->CodLoca = htmlspecialchars(strip_tags($CodLocaIn));
        $sql = "SELECT * FROM " . $this->dataBaseTable . " WHERE CodLoca = :CodLoca";
        $query = $this->connection->prepare($sql);
        $query->bindParam(":CodLoca", $this->CodLoca);
        $query->fetchAll(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query;
    }

    public function createLocalite(string $CodLocaIn, string $LibLocaIn) {
        $this->CodLoca = htmlspecialchars(strip_tags($CodLocaIn));
        $this->LibLoca = htmlspecialchars(strip_tags($LibLocaIn));

        var_dump($this);
        $sql = "INSERT INTO `" . $this->dataBaseTable . "`(`CodLoca`, `LibLoca`)" . " VALUES('" 
        . $this->CodLoca . "', '" . $this->LibLoca . "')";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query;
    }

    public function updateLocalite(string $CodLocaIn, string $LibLocaIn) {
        $this->CodLoca = htmlspecialchars(strip_tags($CodLocaIn));
        $this->LibLoca = htmlspecialchars(strip_tags($LibLocaIn));

        $sql = "UPDATE " . $this->dataBaseTable .
            " SET " .
            " CodLoca = '" . $this->CodLoca . "', LibLoca = '" . $this->LibLoca . 
            "' WHERE " . "CodLoca = " . $this->CodLoca;
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query;
    }

    public function deleteLocalite(string $CodLocaIn) {
        $this->CodLoca = htmlspecialchars(strip_tags($CodLocaIn));
        $sql = "DELETE FROM " . $this->dataBaseTable . " WHERE CodLoca = :CodLoca";
        $query = $this->connection->prepare($sql);
        $query->bindParam(":CodLoca", $this->CodLoca);
        $query->execute();
        return $query;
    }
    public function getCodLoca() :string {
        return $this->CodLoca;
    }
    public function getLibLoca() :string {
        return $this->LibLoca;
    }
}
