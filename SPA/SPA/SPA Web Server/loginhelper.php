
<?php

require_once 'C:\MAMP\htdocs\SeniorProject\spa\vendor\autoload.php';
$code = "12345";

//create client with api key and secret

$client = new Nexmo\Client(new Nexmo\Client\Credentials\Basic('bf3d6fc0', '6e8fca34c48b03c6'));

//send message using simple api params

$message = $client->message()->send([
    'to' => '+905333021885',
    'from' => '905333021885',
    'text' => $code
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
<form method="post" action="authenticator.php">

             <p>One time code is sent. Please generate a code using your SPA app and enter it here<input type="text" name="code"></p>

               <p><button type="submit" name="btnValidate" class="btn btn-primary">Enter</button></p>
                
            </form>
</body>
</html>