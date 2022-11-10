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
        if(isset($data->parlor)){
            $parlor_id=$data->parlor;
            if(isset($data->parlor_tstamp)){
                $parlor_tstamp=$data->parlor_tstamp;
                $i=0;
                while($i < count($parlor_id))
                {
                    $time = date("Y-m-d H:i:s", strtotime($parlor_tstamp[$i]));
                    $sql="CALL add_controller_id_log($c_id,1,$parlor_id[$i],'".$time."')";
                    $dbConn->query($sql);
                    $i++;
                }
                echo json_encode(array('success'=>'Parlor ID communication inserted'));
            }else{
                echo json_encode(array('error' => 'Parlor ID`s send, tstamp missing'));
            }
        }else{
            echo json_encode(array('error' => 'No Parlor ID`s send'));
        }
        if(isset($data->sort)){
            $sort_id=$data->sort;
            if(isset($data->sort_tstamp)){
                $sort_tstamp=$data->sort_tstamp;
                $i=0;
                while($i < count($sort_id))
                {
                    $time = date("Y-m-d H:i:s", strtotime($sort_tstamp[$i]));
                    $sql="CALL add_controller_id_log($c_id,3,$sort_id[$i],'".$time."')";
                    $dbConn->query($sql);
                    $i++;
                }
                echo json_encode(array('success'=>'Sort ID communication inserted'));
            }else{
                echo json_encode(array('error' => 'Sort ID`s send, tstamp missing'));
            }
        }else{
            echo json_encode(array('error' => 'No Sort ID`s send'));
        }
        if(isset($data->feed)){
            $feed_id=$data->feed;
            if(isset($data->feed_tstamp)){
                $feed_tstamp=$data->feed_tstamp;
                $i=0;
                while($i < count($feed_id))
                {
                    $time = date("Y-m-d H:i:s", strtotime($feed_tstamp[$i]));
                    $sql="CALL add_controller_id_log($c_id,2,$feed_id[$i],'".$time."')";
                    $dbConn->query($sql);
                    $i++;
                }
                echo json_encode(array('success'=>'Feed ID communication inserted'));
            }else{
                echo json_encode(array('error' => 'Feed ID`s send, tstamp missing'));
            }
        }else{
            echo json_encode(array('error' => 'No Feed ID`s send'));
        }
    }
    else {
        echo json_encode(array('error' => 'Access denied'));
    }
}