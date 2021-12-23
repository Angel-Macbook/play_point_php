<?php
$domain = $_SERVER['DOCUMENT_ROOT'];

include($domain . "/controller/TimeController.php");
$usersGroupController = new TimeController();
$var = $usersGroupController->get_time();
print_r($var);


$server = $_SERVER;
foreach ($server as $key => $item) {
    print_r($key . " => " . $item);
    echo "<br>";
}