<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
include($domain . "/controller/UsersChildController.php");
$usersGroupController = new UsersChildController();
$var = $usersGroupController->card_event($_GET);

print_r(json_encode($var));