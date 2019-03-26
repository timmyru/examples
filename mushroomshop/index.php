<?php

require_once 'parts/header.php';

if (isset($_GET['cat'])) {
    $currentCat = $_GET['cat'];
    $products = $connect->query("SELECT * FROM products WHERE cat='$currentCat'");
    $products = $products->fetchAll(PDO::FETCH_ASSOC);
    if (!$products) {
        die("Такой категории не найдено");
    }

} else {
    $products = $connect->query("SELECT * FROM products");
    $products = $products->fetchAll(PDO::FETCH_ASSOC);
}

?>

    <div class="main">

        <? foreach ($products as $product) { ?>
        <div class="card">
            <a href="product.php?product=<?=$product['title']?>">
                <img src="img/<?=$product['img']?>" alt="<?=$product['rus_name']?>">
            </a>
            <div class="label"><?=$product['rus_name']?> (<?=$product['price']?> рублей)</div>
            <? require 'parts/add-form.php'?>

        </div>
        <? } ?>

    </div>

</body>
</html>

