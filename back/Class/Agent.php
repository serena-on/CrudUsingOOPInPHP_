<?php

namespace Class;

use Configuration\Database;
use Class\Interface\CrudAgentInterface;

class Agent implements CrudAgentInterface
{
    private $dataBaseTable = "agent";

    private $connection;
    private int $NumMatr;
    private string $NomAgent;
    private string $PrenomAgent;
    private string $DateNais;
    private string $DatePSce;
    private string $password;


    public function __construct(Database $connectionDataBase)
    {
        $this->connection = $connectionDataBase->getConnection();
    }

    public function getAgents()
    {
        $sql = "SELECT * FROM " . $this->dataBaseTable;
        $query = $this->connection->prepare($sql);
        $query->fetchAll(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query;
    }

    public function getAgent(string $PrenomAgentIn)
    {
        $this->PrenomAgent = htmlspecialchars(strip_tags($PrenomAgentIn));
        $sql = "SELECT * FROM " . $this->dataBaseTable . " WHERE PrenomAgent = :PrenomAgent";
        $query = $this->connection->prepare($sql);
        $query->bindParam(":PrenomAgent", $this->PrenomAgent);
        $query->fetchAll(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query;
    }

    public function createAgent(string $NomAgentIn, string $PrenomAgentIn, string $DateNaisIn, string $DatePSceIn, string $passwordIn)
    {
        $this->NomAgent = htmlspecialchars(strip_tags($NomAgentIn));
        $this->PrenomAgent = htmlspecialchars(strip_tags($PrenomAgentIn));
        $this->DateNais = htmlspecialchars(strip_tags($DateNaisIn));
        $this->DatePSce = htmlspecialchars(strip_tags($DatePSceIn));

        $this->password =  password_hash($passwordIn, PASSWORD_ARGON2ID);

        var_dump($this);
        $sql = "INSERT INTO `" . $this->dataBaseTable . "`(`NomAgent`, `PrenomAgent`, `DateNais`, `DatePSce`, `Password`)" . " VALUES('" 
        . $this->NomAgent . "', '" . $this->PrenomAgent . "', '" . $this->DateNais . "', '" . $this->DatePSce . "', '" . $this->password ."')";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query;
    }

    public function updateAgent(string $NomAgentIn, string $PrenomAgentIn, string $DateNaisIn, string $DatePSceIn, string $passwordIn)
    {
        $this->NomAgent = htmlspecialchars(strip_tags($NomAgentIn));
        $this->PrenomAgent = htmlspecialchars(strip_tags($PrenomAgentIn));
        $this->DateNais = htmlspecialchars(strip_tags($DateNaisIn));
        $this->DatePSce = htmlspecialchars(strip_tags($DatePSceIn));

        $this->password =  password_hash($this->password, PASSWORD_ARGON2ID);

        $sql = "UPDATE " . $this->dataBaseTable .
            " SET " .
            " NomAgent = '" . $this->NomAgent . "', PrenomAgent = '" . $this->PrenomAgent . "', DateNais = " . $this->DateNais . ", DatePSce = " . $this->DatePSce . ", Password = '" . $this->password . 
            "' WHERE " . "NumMatr = " . $this->NumMatr;
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query;
    }

    public function deleteAgent(int $idIn)
    {
        $this->id = htmlspecialchars(strip_tags($idIn));
        $sql = "DELETE FROM " . $this->dataBaseTable . " WHERE NumMatr = :NumMatr";
        $query = $this->connection->prepare($sql);
        $query->bindParam(":NumMatr", $this->id);
        $query->execute();
        return $query;
    }
// assert

public function getNumMatr() :int{
    return $this->NumMatr;
}
public function getNomAgent() :string{
    return $this->NomAgent;
}
public function getPrenomAgent() :string{
    return $this->PrenomAgent;
}
public function getDateNais() :string{
    return $this->DateNais;
}
public function getDatePSce() :string{
    return $this->DatePSce;
}
public function getpassword() :string{
    return $this->password;
}
}
