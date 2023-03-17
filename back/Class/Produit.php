<?php

namespace Class;

use Configuration\Database;


class Produit
{
    private $dataBaseTable = "Produit";

    private $connection ;

    private string $CodProd;
    private string $LibProd;
    private int $PrixProd;


    public function __construct(Database $connectionDataBase)
    {
        $this->connection = $connectionDataBase->getConnection();
    }

    public function getAllProduit() {
        $sql = "SELECT * FROM " . $this->dataBaseTable;
        $query = $this->connection->prepare($sql);
        $query->fetchAll(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query;
    }
    public function getProduit(string $CodProdIn) {
        $this->CodProd = htmlspecialchars(strip_tags($CodProdIn));
        $sql = "SELECT * FROM " . $this->dataBaseTable . " WHERE CodProd = :CodProd";
        $query = $this->connection->prepare($sql);
        $query->bindParam(":CodProd", $this->CodProd);
        $query->fetchAll(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query;
    }

    public function createProduit(string $CodProdIn, string $LibProdIn, int $PrixProdIn) {
        $this->CodProd = htmlspecialchars(strip_tags($CodProdIn));
        $this->LibProd = htmlspecialchars(strip_tags($LibProdIn));
        $this->PrixProd = htmlspecialchars(strip_tags($PrixProdIn));

        var_dump($this);
        $sql = "INSERT INTO `" . $this->dataBaseTable . "`(`CodProd`, `LibProd` ,`PrixProd` )" . " VALUES('" 
        . $this->CodProd . "', '" . $this->LibProd . "','" . $this->PrixProd . "')";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query;
    }

    public function updateLocalite(string $CodProdIn, string $LibProdIn, int $PrixProdIn) {
        $this->CodProd = htmlspecialchars(strip_tags($CodProdIn));
        $this->LibProd = htmlspecialchars(strip_tags($LibProdIn));
        $this->PrixProd = htmlspecialchars(strip_tags($PrixProdIn));

        $sql = "UPDATE " . $this->dataBaseTable .
            " SET " .
            " CodProd = '" . $this->CodProd . "', LibProd = '" . $this->LibProd ."', PrixProd = '" . $this->PrixProd ;
            "' WHERE " . "CodProd = " . $this->CodProd;
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query;
    }

    public function deleteProduit(string $CodProdIn) {
        $this->CodProd = htmlspecialchars(strip_tags($CodProdIn));
        $sql = "DELETE FROM " . $this->dataBaseTable . " WHERE CodProd = :CodProd";
        $query = $this->connection->prepare($sql);
        $query->bindParam(":CodProd", $this->CodProd);
        $query->execute();
        return $query;
    }
    public function getCodProd() :string {
        return $this->CodProd;
    }
    public function getLibProd() :string {
        return $this->LibProd;
    }
    public function getPrixProd() :int {
        return $this->PrixProd;
    }
}
