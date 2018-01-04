<?php 


session_start();
require "db_con.php";




if (!empty($_POST['btnLogin'])) {
$username = $_POST["username"];
$bank_id = "Bbank";
$sql = "SELECT username FROM users where username = '".$username."'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
  
$_SESSION["username"] = $username;
$_SESSION["bank_id"] = $bank_id;
header("Location: loginhelper.php"); 
     

}else {
    echo "Username not in database";
}}






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
<form action="login.php" method="post">
<p>Username:<input type="text" name="username" /></p>
<p><input type="submit" name="btnLogin" value="Login"/></p>
</form>
</body>
</html>
