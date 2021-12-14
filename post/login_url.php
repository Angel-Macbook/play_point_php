<?php
//include('../service/DB.php');
$domain = $_SERVER['DOCUMENT_ROOT'];
include($domain . "/controller/UsersController.php");
$usersController = new UsersController();
$var = $usersController->auth($_POST);

print_r(json_encode($var));