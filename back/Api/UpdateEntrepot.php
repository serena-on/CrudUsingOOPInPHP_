<?php

    require_once('../vendor/autoload.php');

    use Exception\EmptydataException;
    use Class\Entrepot;
    use Configuration\Database;

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
   
function updateEntrepot_() {
    $database = new Database();
    $Entrepot = new Entrepot( $database);
    $data = json_decode(json_encode($_POST));
    try {
        if (!isset($data->CodEntrep) && !isset($data->LibEntrep) && !isset($data->AdrEntrep) && !isset($data->CodLoca) ) {
            throw new EmptydataException();
         }
         else {
            try{
                if($Entrepot->updateEntrepot(CodEntrepOut: $data->CodEntrepOut, CodEntrepIn: $data->CodEntrep, LibEntrepIn: $data->LibEntrep, AdrEntrepIn: $data->AdrEntrep,  CodLocaIn: $data->CodLoca)){
                    http_response_code(201);
                    echo json_encode(array("message" => "Entrepot updated"));
                } else{
                    http_response_code(503);
                    echo json_encode(array("message" => "Entrepot could not be updated."));
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

// var_dump($_POST);
updateEntrepot_();