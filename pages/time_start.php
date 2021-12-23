<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
include($domain . '/app/header.php');
include($domain . "/controller/TimeController.php");
$usersGroupController = new TimeController();
$var = $usersGroupController->get_time();
print_r($var['data']['time_start']);
?>

<?php
include($domain . '/app/footer.php');
?>
