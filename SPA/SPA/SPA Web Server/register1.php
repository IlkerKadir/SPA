<?php 


session_start();
require "db_con.php";
require "GoogleAuthenticator.php";

if (!empty($_POST['btnLogin'])) {
$username = $_POST["username"];
$bankID = "1";
$sql = "INSERT INTO `users` (`username`) VALUES 
('".$username."');";
 $_SESSION['username'] = $username;
 $_SESSION ['bank_id'] = $bankID;
$con->query($sql);
header("Location: registerqr.php"); 
     } else {
    echo "0 results";
}


 ?>
 <!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
<link rel="stylesheet" href="css/bootstrap.min.css">

<style type="text/css">
    body{

        margin-top: 150px;
    }
</style>
</head>
<body align="center">

<h1>Login</h1>
<form action="register1.php" method="post">
<p>Username:<input type="text" name="username" /></p>
<p><input type="submit" name="btnLogin" value="Register"/></p>
</form>
</body>
</html>