<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
include($domain . '/app/header.php');
include "$domain/controller/UsersController.php";
?>
<form action="../post/register_url.php"
      method="post"
      onsubmit="register(this); return false"
>
    <label>
        <p>Имя</p>
        <input name="first_name" type="text">
    </label>
    <label>
        <p>Фамилия</p>
        <input name="last_name" type="text">
    </label>
    <label>
        <p>Логин</p>
        <input name="login" type="text">
    </label>
    <label>
        <p>Пароль</p>
        <input name="password" type="password">
    </label>
    <label>
        <p>Повторите пароль</p>
        <input name="re_password" type="password">
    </label>
    <label>
        <p>Вес</p>
        <input name="weight" type="number">
    </label>
    <label>
        <p>Рост</p>
        <input name="height" type="number">
    </label>
    <label>
        <p>Дата рождения</p>
        <input name="date_birth" type="date">
    </label>
    <button type="submit">Отправить форму</button>
</form>
<div class="message"></div>
<?php
include($domain . '/app/footer.php');
?>
