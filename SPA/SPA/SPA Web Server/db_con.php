<?php



$db_name = "spa";
$mysql_user = "kadirspa";
$mysql_pass = "gs1905";
$server_name = "localhost";

$con = mysqli_connect($server_name, $mysql_user, $mysql_pass, $db_name);

if(!$con){
    echo '{"message":"Unable to connect to the database."}';
}

?>