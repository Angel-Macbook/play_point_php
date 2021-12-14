<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
include($domain . "/controller/UsersChildController.php");
$usersGroupController = new UsersChildController();
$var = $usersGroupController->add_groups($_POST);

print_r(json_encode($var));