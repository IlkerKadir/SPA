<?php


session_start();


if(empty($_SESSION['user_id']))
{
    header("Location: index.php");
}

require 'db_connection.php';
require 'library.php';
$db = access_database();

$app = new lib($db);
$user = $app->UserDetails($_SESSION['user_id']);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
   
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<h1>Logged in succesfully!</h1>
<p><a href="logout.php">Click to logout</a></p>
</body>
</html>