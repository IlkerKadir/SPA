<?php
function access_database()
{
    static $inst;
    if ($inst === null) {
        $a = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => FALSE,
        );
        $d = 'mysql:host=' . 'localhost' . ';dbname=' .'bbank' . ';charset=' .'utf8';
        $inst = new PDO($d, 'kadir1','123456', $a);
    }
    return $inst;
}

?>