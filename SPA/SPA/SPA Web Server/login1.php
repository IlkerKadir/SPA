<?php  

session_start();
require "db_con.php";
require_once 'C:\MAMP\htdocs\SeniorProject\spa\vendor\autoload.php';


$user_id = $_SESSION['user_id'] ;
$sql = "SELECT k FROM users where id = '".$user_id."'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $k =  $row["k"];
     
     }
} else {
    echo "0 results";
}


$client = new Nexmo\Client(new Nexmo\Client\Credentials\Basic('bf3d6fc0', '6e8fca34c48b03c6'));

//send message using simple api params
function generatePassword($length, $strength) 
{
    $vowels = '0123456789';
    $consonants = '0123456789';
    if ($strength & 1) 
    {
        $consonants .= '0123456789';
    }
    if ($strength & 2) 
    {
        $vowels .= "0123456789";
    }
    if ($strength & 4) 
    {
        $consonants .= '0123456789';
    }
    if ($strength & 8) 
    {
        $consonants .= '0123456789';
    }
    $password = '';
    $alt = time() % 2;
    for ($i = 0; $i < $length; $i++) 
    {
        if ($alt == 1) 
        {
            $password .= $consonants[(rand() % strlen($consonants))];
            $alt = 0;
        } 
        else 
        {
            $password .= $vowels[(rand() % strlen($vowels))];
            $alt = 1;
        }
    }
    return $password;
}

$otp = generatePassword(6,4);




$message = $client->message()->send([
    'to' => '+905333021885',
    'from' => '905333021885',
    'text' => $otp
]);


echo "Please login from your mobile application with the sms";
?>