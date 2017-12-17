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
    if (strlen($_POST['name']) == 0) {
        $msg = 'Name field is required!';
    } else if (strlen($_POST['email']) == 0) {
        $msg = 'Email field is required!';
    } else if (strlen($_POST['username']) == 0) {
        $msg = 'Username field is required!';
    } else if (!preg_match($regex, $_POST['password']) & strlen($_POST['username'] < 6 ))  {
        $msg = 'Your password should be at least 6 characters,should contain mixed case letters and at least a number.';
    } else if (strlen($_POST['phoneNumber']) != 10) {
        $msg = 'Invalid phone number!';
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $msg = 'Invalid email address!';
    } else if ($app->isEmail($_POST['email'])) {
        $msg = 'Email is already in use!';
    } else if ($app->isUsername($_POST['username'])) {
        $msg = 'Username is already in use!';
    } else {
        $user_id = $app->Register($_POST['name'], $_POST['email'], $_POST['username'], $_POST['password'],$_POST['phoneNumber'], $secret);
        
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
</head>
<body>

 <h1>Register</h1>
            <?php
            if ($msg != "") {
      echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $msg . '</div>'; }
            ?>

  <form action="registration.php" method="post">
 <p>Full Name :<input type="text" name="name" value='<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>'/></p>
 <p>Username :<input type="text" name="username" value='<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>' /></p>
<p>Password :<input type="password" name="password" /></p>
<p>Email :<input type="email" name="email" value='<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>'/>
<p>Phone Number :<input type="text" name="phoneNumber" value='<?php echo isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : ''; ?>' />    
<p><input type="submit" name="btnRegister" value="Sign Up"/></p>
        
</form>

</body>
</html>