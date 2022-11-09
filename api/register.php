<?php



header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// get posted data
$data = json_decode(file_get_contents("php://input", true));


echo json_encode(array('success' => 'You registered successfully'));

}

//End of file
