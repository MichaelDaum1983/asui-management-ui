<?php
session_start();
ini_set('display_errors', 1);
require ('classes/Db.class.php');
$db= new DB();
?>

<!DOCTYPE html>
<html>
<title>ASUI Management</title>
<head>
	<meta charset='UTF-8' name='viewport' content='width=device-width, initial-scale=1'>
	<link rel='stylesheet'
		  href='./css/style.css'>
</head>
<body>
<div class="header-container">
    <div class="header">
        <H1>Demo Header</H1>
    </div>
</div>
<div class="body-container">
    <div class="left">
        <h1>Demo Menu</h1>
    </div>
    <div class="body">
        <h1>Demo Body</h1>
    </div>
    <div class="right">
        <h1>Demo right</h1>
    </div>
</div>
</body>
</html>