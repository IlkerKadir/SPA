<?php 


session_start();

require "db_con.php";

if (!empty($_POST['btnLogin'])) {
$username = $_POST["username"];
$bank_id = "Cbank";
$sql = "INSERT INTO `users` (`username`,`bank_id`) VALUES 
('".$username."','".$bank_id."');";
 $_SESSION['username'] = $username;
 $_SESSION ['bank_id'] = $bank_id;
$con->query($sql);
header("Location: registerqr.php"); 
     } else {
}



 ?>
 <!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
<link rel="stylesheet" href="css/bootstrap.min.css">

<style type="text/css">
    body{

        margin-top: 150px;
    }
</style>
</head>
<body align="center">

<h1>Register</h1>
<form action="register1.php" method="post">
<p>Username:<input type="text" name="username" /></p>
<p><input type="submit" name="btnLogin" value="Register"/></p>
</form>
</body>
</html>