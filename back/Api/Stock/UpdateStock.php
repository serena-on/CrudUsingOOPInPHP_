<?php

require_once('../../vendor/autoload.php');

use Class\User;
use Configuration\Database;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$database = new Database();
$user = new User($database);
$data = json_decode(file_get_contents("php://input"));

if ($user->UpdateUser(idIn: $data->id, nameIn: $data->name, emailIn: $data->email, ageIn: $data->age, passwordIn: $data->password)) {
    echo 'User update successfully.';
} else {
    echo 'User could not be update.';
}
