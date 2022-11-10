<?php
require_once '../classes/Db.class.php';
$dbConn=new db();

function getId($dbConn,$serial){
    $sql="SELECT c_id FROM customers WHERE c_serial='".$serial."'";
    $result = $dbConn->query($sql);
    $result=$result[0]['c_id'];
    return $result;
}