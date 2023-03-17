<?php

    require_once('../vendor/autoload.php');

    use Exception\EmptydataException;
    use Class\Stock;
    use Configuration\Database;

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
   
function createStock_() {
    $database = new Database();
    $Stock = new Stock( $database);
    $data = json_decode(json_encode($_POST));
    try {
        if (!isset($data->QteStock) && !isset($data->QteAvarie) && !isset($data->CodProd) && !isset($data->CodEntrepot) ) {
            throw new EmptydataException();
         }
         else {
            try{
                if($Stock->createStock( QteStockIn: $data->QteStockIn, QteAvarieIn: $data->QteAvarieIn, CodProdIn: $data->CodProdIn,  CodEntrepotIn: $data->CodEntrepotIn)){
                    http_response_code(201);
                    echo json_encode(array("message" => "Stock created"));
                } else{
                    http_response_code(503);
                    echo json_encode(array("message" => "Stock could not be created."));
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
createEntrepot_();