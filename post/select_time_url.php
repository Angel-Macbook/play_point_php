<?php
//include('../service/DB.php');
$domain = $_SERVER['DOCUMENT_ROOT'];
include($domain . "/controller/TimeController.php");
$timeControllerr = new TimeController();
$var = $timeControllerr->select_time($_POST);

print_r(json_encode($var));