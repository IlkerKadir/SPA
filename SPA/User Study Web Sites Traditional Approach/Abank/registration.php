<?php


session_start();

require 'db_connection.php';
require 'library.php';
require_once 'GoogleAuthenticator.php';
$db = access_database();



$app = new lib($db);

$pga = new PHPGangsta_GoogleAuthenticator();
$secret = $pga->createSecret();

$msg = '';

$regex = '~^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])~m';
if (!empty($_POST['btnRegister'])) {
      if (strlen($_POST['username']) == 0) {
        $msg = 'Username field is required!';
    } else if (!preg_match($regex, $_POST['password']) & strlen($_POST['username'] < 8 ))  {
        $msg = 'Your password should be at least 8 characters,should contain mixed case letters and at least a number.';
    } else if ($app->isUsername($_POST['username'])) {
        $msg = 'Username is already in use!';
    } else {
        $user_id = $app->Register($_POST['username'], $_POST['password'], $secret);
        
        $_SESSION['user_id'] = $user_id;
        header("Location: confirm.php");
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style >
      body{
        margin-top: 150px;
      }  

    </style>
</head>
<body align="center">
   <h1>Register</h1>

           <?php
            if ($msg != "") {
      echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $msg . '</div>'; }
            ?>

  <form  action="registration.php" method="post">
    
 <p>Username :<input type="text" name="username" value='<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>' /></p>
<p>Password :<input type="password" name="password"/></p>

<p><input type="submit" name="btnRegister" value="Sign Up"/></p>
        
</form>

</body>
</html>