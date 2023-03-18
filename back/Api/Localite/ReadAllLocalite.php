<?php

require_once('../../vendor/autoload.php');

use Class\Localite;
use Configuration\Database;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

function ReadAll()
{
    $dataBase = new Database();
    $Localites = new Localite($dataBase);
    $getLocalites = $Localites->getAllLocalites();
    $rowCount = $getLocalites->rowCount();
    if ($rowCount > 0) {
        $LocaliteArr = array();
        $LocaliteArr["body"] = array();
        $LocaliteArr["rowCount"] = $rowCount;
        while ($row = $getLocalites->fetch(\PDO::FETCH_ASSOC)) {
            extract($row);
            $e = array(
                "CodLoca" => $CodLoca,
                "LibLoca" => $LibLoca,
            );
            array_push($LocaliteArr["body"], $e);
        }
        return json_encode($LocaliteArr["body"]);
    } else {
        http_response_code(404);
        return json_encode(
            array("message" => "No record found.")
        );
    }
}

echo (ReadAll());
