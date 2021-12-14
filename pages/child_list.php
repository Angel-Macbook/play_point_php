<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
include($domain . '/app/header.php');
include($domain . "/controller/UsersChildController.php");
$usersGroupController = new UsersChildController();
$var = $usersGroupController->get_child_list();
?>
<div class="child_list">
    <?php foreach ($var['data_users'] as $item) { ?>
        <div class="card">
            <div class="img"><img src="" alt=""></div>
            <div class="text">
                <h3><?= $item['name'] ?></h3>
                <?php
                switch ($item['status']) {
                    case 0:
                        $class = 'active';
                        $text = 'В комнате';
                        break;
                    case 1:
                        $class = 'closed';
                        $text = 'Не в комнате';
                        break;
                    default:
                        $class = 'error';
                        $text = 'Неизвесный статус';
                        break;
                }
                ?>
                <p class="<?= $class ?>"><?= $text ?></p>
            </div>
        </div>
    <?php } ?>
</div>
<?php
include($domain . '/app/footer.php');
?>
