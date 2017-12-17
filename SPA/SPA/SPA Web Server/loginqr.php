<?php 
session_start();
require "db_con.php";

$username = $_SESSION["username"];
$bank_id = $_SESSION["bank_id"];

function getQRCodeGoogleUrl($name,$token, $secret) {
        $urlencoded = urlencode($name.$token.$secret);
	    return 'https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl='.$urlencoded.'';
    }
$qrCode = getQRCodeGoogleUrl($username,",",$bank_id);

//$url = "samplepage.php";

//echo '<META HTTP-EQUIV=Refresh CONTENT="30; URL='.$url.'">'; 

?>


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
<p></p>
<p><a href="loginhelper.php"><button>Please Click to Continue after you scan the barcode from SPA app</button></a></p>
</body>
</html>
