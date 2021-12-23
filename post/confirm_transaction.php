<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
include($domain . "/controller/AdminController.php");
$adminController = new AdminController();
$var = $adminController->confirmTransaction($_POST);

print_r(json_encode($var));