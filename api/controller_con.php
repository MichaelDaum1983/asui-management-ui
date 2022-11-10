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
        if(isset($data->controller)){
            $controller_id=$data->controller;
            if(isset($data->controller_tstamp)){
                $controller_tstamp=$data->controller_tstamp;
                $controller_name=$data->controller_name;
                $i=0;
                while($i < count($controller_id))
                {
                    $time = date("Y-m-d H:i:s", strtotime($controller_tstamp[$i]));
                    $sql="CALL add_last_controller_con($c_id,$controller_id[$i],'".$controller_name[$i]."','".$time."')";
                    $dbConn->query($sql);
                    $i++;
                }
                echo json_encode(array('success'=>'Last Controller Connection added'));
            }else{
                echo json_encode(array('error' => 'Last Controller Connection ID`s send, tstamp missing'));
            }
        }else{
            echo json_encode(array('error' => 'No Last Controller Connection ID`s send'));
        }

    }else {
        echo json_encode(array('error' => 'Access denied'));
    }
}