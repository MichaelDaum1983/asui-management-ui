<?php

require_once '../classes/Db.class.php';
require_once 'jwt_utils.php';
require_once 'api_func.php';
$dbConn=new db();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input", true));
    $serial=$data->serial;
    $c_id=getId($dbConn,$serial);
    $bearer_token = get_bearer_token();

    $is_jwt_valid = is_jwt_valid($bearer_token);

    if($is_jwt_valid) {
        if(isset($data->cron_tstamp)){
            $time = date("Y-m-d H:i:s", strtotime($data->cron_tstamp));
            $sql="CALL add_log_cron($c_id,'".$time."')";
            $dbConn->query($sql);
            echo json_encode(array('success' => 'Last Cron start added'));

        }
        else{
            echo json_encode(array('error' => 'cron tstamp missing'));
        }
    }else {
        echo json_encode(array('error' => 'Access denied'));
    }
}