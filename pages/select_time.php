<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
include($domain . '/app/header.php');

?>

<form action="/post/select_time_url.php"
      method="post"
>
    <input type="hidden" name="select_time" value="Select_0">
    <button type="submit">30 минут</button>
</form>
<form action="/post/select_time_url.php"
      method="post"
>
    <input type="hidden" name="select_time" value="Select_1">
    <button type="submit">60 минут</button>
</form>
<form action="/post/select_time_url.php"
      method="post"
>
    <input type="hidden" name="select_time" value="Select_2">
    <button type="submit">90 минут</button>
</form>
<div class="message"></div>
<?php
include($domain . '/app/footer.php');
?>
