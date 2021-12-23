<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
include($domain . '/app/header.php');
include($domain . "/controller/AdminController.php");
$adminController = new AdminController();
$var = $adminController->getTransactionList($_GET['status']??2);
?>

<div class="link_list">
    <a href="transaction_list.php?status=0">Активные</a>
    <a href="transaction_list.php?status=1">Закрытые</a>
    <a href="transaction_list.php?status=2">Ожидающие</a>
    <a href="transaction_list.php?status=3">Отмененные</a>
</div>
<div class="child_list">

    <table class="table">
        <thead>
        <tr>
            <th>№</th>
            <th>Имя</th>
            <th>Время</th>
            <th>Количество детей</th>
            <th>Цена</th>
            <th>Подтвердить</th>
            <th>Отказать</th>
        </tr>
        </thead>
        <?php foreach ($var['data'] as $key => $item) { ?>
        <tbody>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $item['first_name'] . " " . $item['last_name'] ?></td>
                <td><?= $item['count_time'] ?></td>
                <td><?= $item['count_children'] ?></td>
                <td><?= $var['price_list'][$item['count_time']]*$item['count_children'] ?></td>
                <td><form onsubmit="success_transaction(this); return false" action="/post/confirm_transaction.php" method="post"><input type="hidden" name="status" value="0"><input type="hidden" name="id" value="<?= $item['id'] ?>"><button>Принять</button></form></td>
                <td><form onsubmit="closed_transaction(this); return false" action="/post/confirm_transaction.php" method="post"><input type="hidden" name="status" value="3"><input type="hidden" name="id" value="<?= $item['id'] ?>"><button>Отказать</button></form></td>
            </tr>
        <tbody>
        <?php } ?>
    </table>
</div>
<?php
include($domain . '/app/footer.php');
?>
