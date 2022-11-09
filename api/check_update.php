<?php

require_once '../classes/Db.class.php';
require_once 'jwt_utils.php';
$dbConn=new db();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
$data = json_decode(file_get_contents("php://input", true));

$bearer_token = get_bearer_token();

#echo $bearer_token;

$is_jwt_valid = is_jwt_valid($bearer_token);

if($is_jwt_valid) {
	echo json_encode(array('success' => $data));
	$version=$data['version'];
	$sql = "SELECT version_nr FROM version";
	$result = $dbConn->query($sql);
	echo json_encode(array('msg' => 'Update needed to Version '.$result[0]['version_nr'].''));

	echo json_encode(array('success' => $result[0]['version_nr'],'userv'=>$version));

	if((int)$result[0]['version_nr']===(int)$version){
		echo json_encode(array('msg' => 'Latest Version used'));
	}
	else{
		echo json_encode(array('msg' => 'Update needed to Version '.$result[0].''));
	}
} else {
	echo json_encode(array('error' => 'Access denied'));
}