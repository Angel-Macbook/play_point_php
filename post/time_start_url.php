<?php
$domain = $_SERVER['DOCUMENT_ROOT'];

include($domain . "/controller/TimeController.php");
$usersGroupController = new TimeController();
$var = $usersGroupController->get_time();
print_r(json_encode($var));
