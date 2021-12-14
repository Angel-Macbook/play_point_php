<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
include($domain . "/controller/UsersChildController.php");
$usersGroupController = new UsersChildController();
$var = $usersGroupController->select_group($_POST);

print_r(json_encode($var));