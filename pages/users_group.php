<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
include($domain . '/app/header.php');
include($domain . "/controller/UsersChildController.php");
$usersGroupController = new UsersChildController();
$get_groups_users = $usersGroupController->get_groups_users(0);
?>

<form action="/post/users_group_url.php"
      method="post"
>
    <!--    onsubmit="register(this); return false"   -->
    <!--    --><?php
    //    if (!isset($_SESSION['auth'])) { ?>
    <!--    <label>-->
    <!--        <p>Ваше имя</p>-->
    <!--        <input name="name" type="text">-->
    <!--    </label>-->
    <!--    --><?php
    //    }
    ?>
    <label>
        <p>группа</p>
        <select name="group_id">
            <?php
            foreach ($get_groups_users['data']['users_group'] as $item) {
                echo "<option value='" . $item['id'] . "'>" . $item['code'] . "</option>";
            }
            ?>
        </select>
    </label>
    <button type="submit">Отправить форму</button>
</form>
<p>или создайте новую группу</p>
<form action="/post/add_group_url.php"
      method="post"
>
    <label>
        <button type="submit">Создать</button>
    </label>

</form>
<div class="message"></div>
<?php
include($domain . '/app/footer.php');
?>
