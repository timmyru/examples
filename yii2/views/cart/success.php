<?
$this->title = 'Спасибо за заказ';

?>

<div class="container" style="padding: 100px">

    <h1>Ваш заказ #<?=$currentId?> на сумму <?=$session['cart.totalSum']?> рублей принят</h1>
    <hr>
    Ваше имя: <?=$_POST['username']?> <br>
    Ваш телефон: <?=$_POST['phone']?> <br>
    Ваш email: <?=$_POST['email']?> <br>
    Ваш адрес: <?=$_POST['address']?> <br>
    <hr>
    Вы заказали:
    <?foreach ($session['cart'] as $product) { ?>
        <div><?=$product['title']?> в количестве <?=$product['quantity']?>шт.</div>
    <? } ?>
    <hr>
    <a href="/" class="btn-grey">На главную страницу</a>

</div>

<?php

$session->remove('cart');
$session->remove('cart.totalQuantity');
$session->remove('cart.totalSum');
