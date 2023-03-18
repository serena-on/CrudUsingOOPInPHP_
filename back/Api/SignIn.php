<?php

    require_once('../vendor/autoload.php');

    use Exception\EmptydataException;
    use Exception\TypeAgeException;
    use Class\Agent;
    use Configuration\Database;

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
   
function SignIn_() {
    $database = new Database();
    $agent = new Agent( $database);
    $data = json_decode(json_encode($_POST));
    try {
        if ( !isset($data->Username)  && !isset($data->password)) {
            throw new EmptydataException();
         }
         else {
            try{
                $getAgent = $agent->getAgent(htmlspecialchars(strip_tags($data->Username)));
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
                            "Username" => $Username,
                            "DatePSce" => $DatePSce,
                            "Password" => $Password
                         );
                        array_push($agentArr["body"], $e);
                    }
                    if(password_verify($_POST["password"], $agentArr["body"][0]["Password"])) {
                        echo json_encode(
                            array("message" => "Good Password")
                        );
                    } else {
                        echo json_encode(
                            array("message" => "Wrong Password")
                        );
                    }
                } else {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "No record Found.")
                    );
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
SignIn_();