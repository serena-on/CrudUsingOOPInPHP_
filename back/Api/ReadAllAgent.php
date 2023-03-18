<?php

require_once('../vendor/autoload.php');

use Class\Agent;
use Configuration\Database;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

function ReadAll() {
    $dataBase = new Database();
    $agents = new Agent($dataBase);
    $getAgents = $agents->getAgents();
    $rowCount = $getAgents->rowCount();
    if ($rowCount > 0) {
        $agentArr = array();
        $agentArr["body"] = array();
        $agentArr["rowCount"] = $rowCount;
        while ($row = $getAgents->fetch(\PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
               "NumMatr" => $NumMatr,
               "NomAgent" => $NomAgent,
               "PrenomAgent" => $PrenomAgent,
               "DateNais" => $DateNais,
               "DatePSce" => $DatePSce,
               "password" => $Password
            );
            array_push($agentArr["body"], $e);
        }
        return json_encode($agentArr);
    } else {
        http_response_code(404);
        return json_encode(
            array("message" => "No record found.")
        );
    }
}

echo(ReadAll());