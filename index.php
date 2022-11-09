
<?php
/*
* Copyright (c) 2022. Michael Daum, Dachshund-Development with the Approval of BouMatic, Günter Korthauer, Technical Director Europe
*/
session_start();
ini_set('display_errors', 1);
require ('classes/Db.class.php');
$login="";
if(isset($_GET['wrong_login'])){
    $login="Wrong Username or Password<br>";
}
?>
<!DOCTYPE html>
<html>
    <title>ASUI Management</title>
    <head>
        <meta charset='UTF-8' name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet'
              href='./css/login_style.css'>
        <script type='text/javascript' src='js/login.js'></script>
    </head>
    <body>
        <div class="login">
            <form method="post" action="check_login.php?login=1">
            <H1>Login</H1>
                <?php
				echo $login;
                ?>
                <label for="userid">User E-Mail</label>
                <input type="text" size="40" maxlength="250" name="user" id="userId">
                <br><br>
                <label for="password">Password</label>
                <input type="password" size="40"  maxlength="250" name="password" id="userPw"><br><br>
                <button>Login</button>
            </form>
        </div>
    </body>
</html>
