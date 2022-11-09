<?php
session_start();
ini_set('display_errors', 1);
require('classes/Db.class.php');
$db= new DB();
if(isset($_GET['login'])) {
	$user = $_POST['user'];
	$password = $_POST['password'];
	$user=$db->query("SELECT * FROM users WHERE u_mail='$user' AND active=1");
	//Check the Password
	$result=password_verify($password, $user[0]['u_password']);
	if ($user !== false && password_verify($password, $user[0]['u_password'])) {
		session_regenerate_id();
		$_SESSION['userid'] = $user[0]['u_id'];
		$_SESSION['username'] = $user[0]['u_name'];
		$_SESSION['user_role']=$user[0]['u_role'];
		header("Location: index_2.php");
		exit;
	}
	else{
		header("Location: index.php?wrong_login=1");
		exit;
	}
}