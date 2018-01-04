<?php

/*

session_start();
require "db_con.php";

ignore_user_abort(true);
set_time_limit(0);

$username = $_SESSION["username"];


$success = false;
while($success === false) {
 $sql = "SELECT sms_code FROM users where username = '".$username."'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $k =  $row["sms_code"];
     
     }

 }
if(!is_null($k)){
    $success = true;
}
    // attempt what you are trying to do, set $success to true if it works
    if ($success === true) {
        continue;
    } else {
        
    }

    }

*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>Success</title>
    <style type="text/css">
        
       body{
            margin-top: 150px;
        }


    </style>
</head>
<body align="center">
<h1>Registration succesfull</h1>
<pre>
<a href="login.php">Click to Login</a>
</pre>
</body>
</html>