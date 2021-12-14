<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
include($domain.'/app/header.php');
include ($domain.'/controller/UsersController.php');
?>
<form action="../post/login_url.php"
      method="post"
      onsubmit="register(this); return false"
>
<!--    onsubmit="register(this); return false"-->
    <label>
        <p>Логин</p>
        <input name="login" type="text">
    </label>
    <label>
        <p>Пароль</p>
        <input name="password" type="password">
    </label>
    <button type="submit">Отправить форму</button>
</form>
<div class="message"></div>
<?php
include($domain.'/app/footer.php');
?>
