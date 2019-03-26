<?
use yii\helpers\Url;
use yii\widgets\LinkPager;
$this->title = $goods[0]['rus_catname'];

if ($_GET['cat']=='new') {
    $cat = 'new';
} else {
    $cat = $_GET['cat'];
}

?>

<?
//echo "<pre>";
//var_dump($goods);
//echo "</pre>";
?>


<div id="body">
    <div class="container">
        <div class="products-wrap">
            <aside id="sidebar">
                <div class="widget">
                    <h3>Products per page:</h3>
                    <fieldset>
                        <input class="product-quantity" <? if ($_GET['pageSize']==4 || !$_GET['pageSize']) {echo 'checked';}?> type="checkbox" onclick="location.href='<?=Url::to(['/category/view', 'cat'=>$cat, 'pageSize'=>4])?>'">
                        <label>4</label>
                        <input class="product-quantity" <? if ($_GET['pageSize']==8) {echo 'checked';}?> type="checkbox" onclick="location.href='<?=Url::to(['/category/view', 'cat'=>$cat, 'pageSize'=>8])?>'">
                        <label>8</label>
                        <input class="product-quantity" <? if ($_GET['pageSize']==12) {echo 'checked';}?> type="checkbox" onclick="location.href='<?=Url::to(['/category/view', 'cat'=>$cat, 'pageSize'=>12])?>'">
                        <label>12</label>
                    </fieldset>
                </div>
<!--                <div class="widget">-->
<!--                    <h3>Sort by:</h3>-->
<!--                    <fieldset>-->
<!--                        <input class="sortby" checked type="checkbox">-->
<!--                        <label>Popularity</label>-->
<!--                        <input class="sortby" type="checkbox">-->
<!--                        <label>Date</label>-->
<!--                        <input class="sortby" type="checkbox">-->
<!--                        <label>Price</label>-->
<!--                    </fieldset>-->
<!--                </div>-->
                <? if ($goods[0]['category'] != 'gift_card') { ?>
                <div class="widget">
                    <h3>Condition:</h3>
                    <fieldset>
                        <input class="condition" value="new" checked type="checkbox">
                        <label>New</label>
                        <input class="condition" value="used" checked type="checkbox">
                        <label>Used</label>
                    </fieldset>
                </div>
                <? } ?>
<!--                <div class="widget">-->
<!--                    <h3>Price range:</h3>-->
<!--                    <fieldset>-->
<!--                        <div id="price-range"></div>-->
<!--                    </fieldset>-->
<!--                </div>-->
            </aside>
    <h id="content">
        <section class="products">
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]); ?>

            <? if($search) {?>
                <h1 style="margin-left: 100px">Результаты поиска по запросу "<?=$search?>"</h1>
            <?}?>

            <? if(!$goods) { ?>
                <h2 style="margin-left: 100px">Ничего не найдено :(</h2>
            <? } ?>

            <? foreach ($goods as $good) {?>
            <article data-condition="<?=$good['condition']?>">
                <a href="<?=Url::to(['/product/', 'id'=>$good['id']])?>"><img src="/images/<?=$good['photo']?>" alt=""></a>
                <h3 style="margin: 0; padding: 0"><a href="<?=Url::to(['/product/', 'id'=>$good['id']])?>"><?=$good['title']?></a></h3>
                <h4 style="margin: 0; padding: 0"><a href="<?=Url::to(['/product/', 'id'=>$good['id']])?>">$<?=$good['price']?></a></h4>
                <? if(!Yii::$app->user->isGuest) { ?> <span style="font-size: 8px">с учетом скидки 10%</span> <? } ?>
                <a href="#" data-id="<?=$good['id']?>" class="btn-add">Add to cart</a>
            </article>
            <?}?>
        </section>
    </div>
    <!-- / content -->
        </div>

    </div>
    <!-- / container -->
</div>
<!-- / body -->