<?php

namespace Class;

use Configuration\Database;
use Class\Interface\CrudEntrepotInterface;

class Entrepot implements CrudEntrepotInterface
{
    private $dataBaseTable = "entrepot";

    private $connection;

    private string $CodEntrep;
    private string $LibEntrep;
    private string $AdrEntrep;
    private string $CodLoca;


    public function __construct(Database $connectionDataBase)
    {
        $this->connection = $connectionDataBase->getConnection();
    }

    public function getEntrepots() {
        $sql = "SELECT * FROM " . $this->dataBaseTable;
        $query = $this->connection->prepare($sql);
        $query->fetchAll(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query;
    }
    public function getEntrepot(string $CodEntrepIn) {
        $this->CodEntrep = htmlspecialchars(strip_tags($CodEntrepIn));
        $sql = "SELECT * FROM " . $this->dataBaseTable . " WHERE CodEntrep = :CodEntrep";
        $query = $this->connection->prepare($sql);
        $query->bindParam(":CodEntrep", $this->CodEntrep);
        $query->fetchAll(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query;
    }

    public function createEntrepot(string $CodEntrepIn, string $LibEntrepIn, string $AdrEntrepIn, string $CodLocaIn) {
        $this->CodEntrep = htmlspecialchars(strip_tags($CodEntrepIn));
        $this->LibEntrep = htmlspecialchars(strip_tags($LibEntrepIn));
        $this->AdrEntrep = htmlspecialchars(strip_tags($AdrEntrepIn));
        $this->CodLoca = htmlspecialchars(strip_tags($CodLocaIn));

        var_dump($this);
        $sql = "INSERT INTO `" . $this->dataBaseTable . "`(`CodEntrep`, `LibEntrep`, `AdrEntrep`, `CodLoca`)" . " VALUES('" 
        . $this->CodEntrep . "', '" . $this->LibEntrep . "', '" . $this->AdrEntrep . "', '" . $this->CodLoca . "')";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query;
    }

    public function updateEntrepot(string $CodEntrepIn, string $LibEntrepIn, string $AdrEntrepIn, string $CodLocaIn) {
        $this->CodEntrep = htmlspecialchars(strip_tags($CodEntrepIn));
        $this->LibEntrep = htmlspecialchars(strip_tags($LibEntrepIn));
        $this->AdrEntrep = htmlspecialchars(strip_tags($AdrEntrepIn));
        $this->CodLoca = htmlspecialchars(strip_tags($CodLocaIn));

        $sql = "UPDATE " . $this->dataBaseTable .
            " SET " .
            " CodEntrep = '" . $this->CodEntrep . "', LibEntrep = '" . $this->LibEntrep . "' , AdrEntrep = '" . $this->AdrEntrep . "' , CodLoca = '" . $this->CodLoca . 
            "' WHERE " . "CodEntrep = '" . $this->CodEntrep . "'";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query;
    }

    public function deleteEntrepot(string $CodEntrepIn) {
        $this->CodEntrep = htmlspecialchars(strip_tags($CodEntrepIn));
        $sql = "DELETE FROM " . $this->dataBaseTable . " WHERE CodEntrep = :CodEntrep";
        $query = $this->connection->prepare($sql);
        $query->bindParam(":CodEntrep", $this->CodEntrep);
        $query->execute();
        return $query;
    }
    public function getCodEntrep() :string {
        return $this->CodEntrep;
    }
    public function getLibEntrep() :string {
        return $this->LibEntrep;
    }
    public function getAdrEntrep() :string {
        return $this->AdrEntrep;
    }
    public function getCodLoca() :string {
        return $this->CodLoca;
    }
}
