<?php

require_once('../vendor/autoload.php');

use Class\Entrepot;
use Configuration\Database;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

function Read()
{
    $dataBase = new Database();
    $entrepots = new Entrepot($dataBase);
    $getEntrepot = $entrepots->getEntrepot(CodEntrepIn: htmlspecialchars($_GET["CodEntrep"]));
    $rowCount = $getEntrepot->rowCount();
    if ($rowCount > 0) {
        $entrepotArr = array();
        $entrepotArr["body"] = array();
        $entrepotArr["rowCount"] = $rowCount;
        while ($row = $getEntrepot->fetch(\PDO::FETCH_ASSOC)) {
            extract($row);
            $e = array(
                "CodEntrep" => $CodEntrep,
                "LibEntrep" => $LibEntrep,
                "AdrEntrep" => $AdrEntrep,
                "CodLoca" => $CodLoca
            );
            array_push($entrepotArr["body"], $e);
        }
        return json_encode($entrepotArr["body"]);
    } else {
        http_response_code(404);
        return json_encode(
            array("message" => "No record found.")
        );
    }
}

echo (Read());