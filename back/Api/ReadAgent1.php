<?php

require_once('../vendor/autoload.php');

use Class\Agent;
use Configuration\Database;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
function read()
{
    $dataBase = new Database();
    $users = new Agent($dataBase);
    $getAgent = $users->getAgent(htmlspecialchars(strip_tags($_GET['Username'])));
    $rowCount = $getAgent->rowCount();

    if ($rowCount > 0) {
        $agentArr = array();
        $agentArr["body"] = array();
        $agentArr["rowCount"] = $rowCount;
        while ($row = $getAgent->fetch(\PDO::FETCH_ASSOC)) {
            extract($row);
            $e = array(
                "NumMatr" => $NumMatr,
                "NomAgent" => $NomAgent,
                "PrenomAgent" => $PrenomAgent,
                "DateNais" => $DateNais,
                "DatePSce" => $DatePSce,
                "Username" => $Username
            );
            array_push($agentArr["body"], $e);
        }
        return json_encode($agentArr["body"][0]);
    } else {
        http_response_code(404);
        return json_encode(
            array("message" => "No record Found.")
        );
    }
}
echo (read());
