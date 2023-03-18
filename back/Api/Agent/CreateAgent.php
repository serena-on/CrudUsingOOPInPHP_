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
   
function createAgent_() {
    $database = new Database();
    $agent = new Agent( $database);
    $data = json_decode(json_encode($_POST));
    try {
        if (!isset($data->Email) && !isset($data->Username) && !isset($data->NumMatr) && !isset($data->NomAgent) && !isset($data->PrenomAgent) && !isset($data->DateNais) && !isset($data->DatePSce) && !isset($data->password) && !isset($data->Email)) {
            throw new EmptydataException();
         }
         else {
            try{
                if($agent->createAgent(UsernameIn: $data->Username, NomAgentIn: $data->NomAgent, PrenomAgentIn: $data->PrenomAgent, DateNaisIn: $data->DateNais, DatePSceIn: $data->DatePSce, passwordIn: $data->password, EmailIn: $data->Email)){
                    http_response_code(200);
                    // echo json_encode(array("message" => "Agent crée avec succès."));
                    header("Location:../../../Front/ReadAllEntrepot.html");
                } else{
                    http_response_code(503);
                    echo json_encode(array("message" => "Agent could not be created."));
                }                   
            }
            catch(Exception $e){
                http_response_code(503);
                echo json_encode(array("message" => $e->getMessage()));
            }
        }
    } catch (EmptydataException $e) {
        echo json_encode(array("message" => $e->getMessage()));
    }
}

createAgent_();
