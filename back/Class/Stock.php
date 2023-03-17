<?php

namespace Class;

use Configuration\Database;
use Class\Produit;
use Class\Entrepot;

class Stock
{
    private $dataBaseTable = "Stocker";

    private $connection ;

    private int  $QteStock;
    private int  $QteAvarie;
    private string $CodProd;
    private string $CodEntrepot;


    public function __construct(Database $connectionDataBase)
    {
        $this->connection = $connectionDataBase->getConnection();
    }

    public function getAllStock() {
        $sql = "SELECT * FROM " . $this->dataBaseTable;
        $query = $this->connection->prepare($sql);
        $query->fetchAll(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query;
    }
    public function getStock(Produit $CodProdIn, Entrepot $CodEntrepotIn) {
        $this->CodProd = htmlspecialchars(strip_tags($CodProdIn->getCodProd()));
        $this->CodEntrepot = htmlspecialchars(strip_tags($CodEntrepotIn->getCodEntrep()));
        $sql = "SELECT * FROM " . $this->dataBaseTable . " WHERE CodProd = :CodProd AND CodEntrepot = :CodEntrepot";
        $query = $this->connection->prepare($sql);
        $query->bindParam(":CodProd", $this->CodProd , ":CodEntrepot", $this->CodEntrepot );
        $query->fetchAll(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query;
    }

    public function createStock(Produit $CodProdIn, Entrepot $CodEntrepotIn , int $QteStockIn, int $QteAvarieIn) {
        $this->CodProd = htmlspecialchars(strip_tags($CodProdIn->getCodProd()));
        $this->CodEntrepot = htmlspecialchars(strip_tags($CodEntrepotIn->getCodEntrep()));
        $this->QteStock = htmlspecialchars(strip_tags($QteStockIn));
        $this->QteAvarie = htmlspecialchars(strip_tags($QteAvarieIn));

        var_dump($this);
        $sql = "INSERT INTO `" . $this->dataBaseTable . "`(`CodProd`, `CodEntrepot`,`QteStock`,`QteAvarie`)" . " VALUES('" 
        . $this->CodProd . "', '" . $this->CodEntrepot . "','" . $this->QteStock . "','" . $this->QteAvarie . "')";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query;
    }

    public function updateStock(String $CodProdIn, String $CodEntrepotIn , int $QteStockIn, int $QteAvarieIn) {
        $this->CodProd = htmlspecialchars(strip_tags($CodProdIn));
        $this->CodEntrepot = htmlspecialchars(strip_tags($CodEntrepotIn));
        $this->QteStock = htmlspecialchars(strip_tags($QteStockIn));
        $this->QteAvarie = htmlspecialchars(strip_tags($QteAvarieIn));

        $sql = "UPDATE " . $this->dataBaseTable .
            " SET " .
            " CodProd = '" . $this->CodProd . "', CodEntrepot = '" . $this->CodEntrepot ."', QteStock = '" . $this->QteStock . "', QteAvarie = '" . $this->QteAvarie . 
            "' WHERE " . "CodProd = " . $this->CodProd . " AND CodEntrepot = " . $this->CodEntrepot;
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query;
    }

    public function deleteStock(String $CodProdIn, String $CodEntrepotIn) {
        $this->CodProd = htmlspecialchars(strip_tags($CodProdIn));
        $this->CodEntrepot = htmlspecialchars(strip_tags($CodEntrepotIn));
        $sql = "DELETE FROM " . $this->dataBaseTable . " WHERE CodProd = :CodProd AND CodEntrepot = :CodEntrepot";
        $query = $this->connection->prepare($sql);
        $query->bindParam(":CodProd", $this->CodProd , ":CodEntrepot", $this->CodEntrepot);
        $query->execute();
        return $query;
    }
    public function getQteStock() :int {
        return $this->QteStock;
    }
    public function getQteAvarie() :int {
        return $this->QteAvarie;
    }
    public function getCodProd() :string {
        return $this->CodProd;
    }
    public function getCodEntrepot() :string {
        return $this->CodEntrepot;
    }
}
