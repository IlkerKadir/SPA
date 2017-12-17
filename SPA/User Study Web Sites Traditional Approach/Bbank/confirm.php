<?php


session_start();


require'db_connection.php';
require 'library.php';
require_once 'GoogleAuthenticator.php';
$db = access_database();
$app = new lib($db);
$user = $app->UserDetails($_SESSION['user_id']);


$pga = new PHPGangsta_GoogleAuthenticator();
$qr_code =  $pga->getQRCodeGoogleUrl($user->email, $user->google_secret_code, 'Bbank');

$msg = '';

if (isset($_POST['btnValidate'])) {

    $code = $_POST['code'];

    if ($code == "") {
        $msg = 'Please Scan the QR code';
    }
    else
    {
        if($pga->verifyCode($user->google_secret_code, $code, 2))
        {
            // success
            header("Location: success.php");
        }
        else
        {
            // fail
            $msg = 'Invalid Authentication Code!';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm User Device</title>
  
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<h1>Please scan your phone</h1>
<img src="<?php echo $qr_code; ?>">
<form method="post" action="confirm.php">
<?php
if ($msg != "") {
echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $msg . '</div>';
    }
    ?>
<p>Please Enter Authentication Code<input type="text" name="code" ></p>
<p><button type="submit" name="btnValidate" class="btn btn-primary">Validate</button></p>
</form>
</body>
</html>
