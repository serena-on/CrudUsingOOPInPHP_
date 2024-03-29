<?php

require_once('../../vendor/autoload.php');

use Exception\EmptydataException;
use Exception\TypeAgeException;
use Class\Agent;
use Configuration\Database;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function updateAgent_()
{
    $database = new Database();
    $agent = new Agent($database);
    $data = json_decode(json_encode($_POST));
    try {
        if (!isset($data->Email) && !isset($data->Username) && !isset($data->NumMatr) && !isset($data->NomAgent) && !isset($data->PrenomAgent) && !isset($data->DateNais) && !isset($data->DatePSce) && !isset($data->password) && !isset($data->Email)) {
            throw new EmptydataException();
        } else {
            try {
                if ($agent->updateAgent(UsernameIn: $data->Username, NomAgentIn: $data->NomAgent, PrenomAgentIn: $data->PrenomAgent, DateNaisIn: $data->DateNais, DatePSceIn: $data->DatePSce, passwordIn: $data->password, EmailIn: $data->Email)) {
                    http_response_code(201);
                    echo json_encode(array("message" => "Agent updated"));
                } else {
                    http_response_code(503);
                    echo json_encode(array("message" => "Agent could not be updated."));
                }
            } catch (Exception $e) {
                http_response_code(503);
                echo json_encode(array("message" => $e->getMessage()));
            }
        }
    } catch (EmptydataException $e) {
        echo json_encode(array("message" => $e->getMessage()));
    }
}

// var_dump($_POST);
updateAgent_();
