<?php


session_start();


require 'db_connection.php';
require 'library.php';
require 'log.php';
$db = access_database();


$app = new lib($db);
$log=new logging();
$log->lfile('C:\MAMP\htdocs\SeniorProject\logb.txt');
$msg = '';


if (!empty($_POST['btnLogin'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $log->lwrite($_SESSION['user_id']." - ".'login attempt');
    if ($username == "") {
        $msg = 'Username is required!';
    } else if ($password == "") {
        $msg = 'Password is required!';
    } else {
        
        $user_id = $app->Login($username, $password);
        if($user_id > 0)
        {
            $_SESSION['user_id'] = $user_id; 
            header("Location: authenticator.php"); 
        }
        else
        {
            $log->lwrite($_SESSION['user_id']. " - ".'Wrong Password');
            $msg = 'Invalid username or password';
        }
    }
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
<?php
   if ($msg != "") {
        echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $msg . '</div>';
    }
?>
<form action="login.php" method="post">
<p>Username:<input type="text" name="username" /></p>
<p>Password:<input type="password" name="password" /></p>
<p><input type="submit" name="btnLogin" value="Login"/></p>
</form>
           
<p>Not Registered Yet? <a href="registration.php">Register Here</a></p>
          
</body>
</html>