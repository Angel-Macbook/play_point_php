<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
include($domain . "/controller/UsersChildController.php");
$usersGroupController = new UsersChildController();
//$var = $usersGroupController->add_child($_POST);
$var = $usersGroupController->add_child($_GET);

//print_r(json_encode($var));