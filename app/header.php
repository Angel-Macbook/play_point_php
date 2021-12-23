<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/public/css/index.css">
    <title>Document</title>
</head>
<body>
<div class="menu">
    <?php if (!isset($_SESSION['auth'])) { ?>
        <a href="/pages/register.php">Регистрация</a>
        <a href="/pages/login.php">Авторизация</a>
    <?php } else {?>
        <a href="/post/logout_post.php">Выйти из аккаунта</a>
    <?php }?>
    <!--    <a href="/pages/users_group.php">Добавление группы</a>-->
    <a href="/pages/select_time.php">Добавление времени</a>
    <a href="/pages/time_start.php">Сколько времени осталось</a>
    <a href="/pages/child_list.php">Список детей</a>
    <a href="/pages/transaction_list.php">Список трансаций</a>
</div>
<div class="answer_message_right">Успешно сохранено</div>
<?php

?>