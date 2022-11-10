<?php

require_once '../classes/Db.class.php';
require_once 'jwt_utils.php';
$dbConn=new db();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input", true));
    $serial=$data->serial;
    $bearer_token = get_bearer_token();

    $is_jwt_valid = is_jwt_valid($bearer_token);

    if($is_jwt_valid) {

    }else {
        echo json_encode(array('error' => 'Access denied'));
    }
}