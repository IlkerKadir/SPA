<?php

session_start();
require "db_con.php";

require_once 'C:\MAMP\htdocs\SeniorProject\spa\vendor\autoload.php';

$username = $_SESSION["username"];
$bank_id = $_SESSION["bank_id"];

$code = mt_rand(100000, 999999);
$msg = $bank_id . ":" . $username . "," . $code . ",";  

//create client with api key and secret

$client = new Nexmo\Client(new Nexmo\Client\Credentials\Basic('bf3d6fc0', '6e8fca34c48b03c6'));

$sql = "SELECT `key` FROM users where username = '".$username."' and bank_id = '".$bank_id."'";

$result = $con->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $k =  $row["key"];
     
     }

 }

$sql = "SELECT `sms_code` FROM users where username = '".$username."' and bank_id = '".$bank_id."'";

$result = $con->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $sms_code =  $row["sms_code"];
     
     }
}

if(!empty($_POST["code"])){
   $mycode = $_POST["code"];
   if($mycode == $sms_code){
    header("Location: success2.php");
   }else{
echo "Wrong authentication code";
   }
}




$message = $client->message()->send([
    'to' => '+905318567101',
    'from' => '+905318567101',
    'text' => $msg
]);





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
<form method="post" action="loginhelper.php">

             <p>One time code is sent. Please generate a code using your SPA app and enter it here<input type="text" name="code"></p>

               <p><button type="submit" name="btnValidate" class="btn btn-primary">Enter</button></p>
                
            </form>
</body>
</html>