<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
include($domain . "/controller/UsersChildController.php");
$usersGroupController = new UsersChildController();
$var = $usersGroupController->get_child_list();

print_r(json_encode($var));