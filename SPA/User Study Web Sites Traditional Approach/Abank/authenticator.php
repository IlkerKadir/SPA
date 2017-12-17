<?php
session_start();

require 'db_connection.php';
require 'library.php';
require_once 'GoogleAuthenticator.php';
require 'log.php';
$log=new logging();
$log->lfile('C:\MAMP\htdocs\SeniorProject\loga.txt');
$db = access_database();

$app = new lib($db);
$user = $app->UserDetails($_SESSION['user_id']);


$pga = new PHPGangsta_GoogleAuthenticator();

$msg = '';




if (isset($_POST['btnValidate'])) {

    $code = $_POST['code'];

    if (strlen($code == 0)) {
        $msg = 'Please enter the code that you recieved';
    }
    else
    {
        if($pga->verifyCode($user->google_secret_code, $code, 2))
        {
            // success
            
            $log->lwrite($_SESSION['user_id'] . " - ".'succesful login');
            header("Location: success2.php");
        }
        else
        {
            // fail
            $msg = 'Invalid Authentication Code!, Please try again.';
        }
    }
}
?>
<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>Authentication Code</title>
    
<link rel="stylesheet" href="css/bootstrap.min.css">
<style type="text/css">
    body{

        margin-top: 150px;
    }

</style>
</head>

<body align="center">
<h1>Authentication code</h1>
<form method="post" action="authenticator.php">
<?php
  if ($msg != "") {
    echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $msg . '</div>';
    }
?>
                <p>Please enter the code from your mobile phone<input type="text" name="code"></p>
                <button type="submit" name="btnValidate" class="btn btn-primary">Enter</button>
                
            </form>

          
   

</body>
</html>