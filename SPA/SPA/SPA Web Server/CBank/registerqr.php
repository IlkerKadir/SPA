<?php 

session_start();


require "db_con.php";


$username =  $_SESSION['username'];
$bank_id =  $_SESSION ['bank_id'];

//$_SESSION['username'] = $username;

function getQRCodeGoogleUrl($name,$token, $secret) {
        $urlencoded = urlencode($name.$token.$secret);
        return 'https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl='.$urlencoded.'';
    }

$qrCode = getQRCodeGoogleUrl($username,",",$bank_id); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm User Device</title>
  
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style type="text/css">
        
        body{

            margin-top: 100px;
        }
    </style>
</head>
<body align="center">
<h1>Please scan your phone</h1>
<img src="<?php echo $qrCode; ?>">
<p><a href="success.php">Click to continue</a></p>
</body>
</html>




