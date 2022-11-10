<?php

require_once '../classes/Db.class.php';
require_once 'jwt_utils.php';
$dbConn=new db();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// get posted data
	$data = json_decode(file_get_contents("php://input", true));

	// Get the users PW hash from DB
	$sql = "SELECT u_password FROM users WHERE u_mail='" .$data->username. "'";
	$result = $dbConn->query($sql);
	//echo json_encode(array('SQL Query PW;' => $result));
	$passworddb=$result[0]['u_password'];
	$access=password_verify($data->password,$passworddb);
	//echo json_encode(array('Result PW verify' => $access));

	if($access=0) {
		echo json_encode(array('error' => 'Invalid User'));
	} else {
		//echo json_encode(array('Password' => 'verified'));
		$sql="SELECT 1 as nr FROM customers WHERE c_serial='".$data->serial."'";
		$result = $dbConn->query($sql);
		if($result[0]['nr']!=1){
			echo json_encode(array('Error' => 'Serial Nr Unknown. Contact Techsupport'));
		}
		else{
			$headers = array('alg'=>'HS256','typ'=>'JWT');
			$payload = array('username'=>$data->username, 'exp'=>(time() + 30000));
			$jwt = generate_jwt($headers, $payload);

			echo json_encode(array('token' => $jwt));
		}
	}
}

//End of file