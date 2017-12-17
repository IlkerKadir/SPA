<?php  

require "db_con.php";

$username = $_POST["username"];
$k = $_POST["k"];

$sql = "update `users` set `k` = '".$k."' where `username` = '".$username."' ;";


if(!mysqli_query($con, $sql)){
	echo '{"message":"Unable to save the data to the database."}';
}




?>