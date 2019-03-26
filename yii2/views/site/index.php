<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = 'Главная страница';
?>


<div id="slider">
    <ul>
        <li style="background-image: url('/images/0.jpg')">
            <h3>Make your life better</h3>
            <h2>Genuine diamonds</h2>
            <a href="/category/rings" class="btn-more">Read more</a>
        </li>
        <li class="purple" style="background-image: url(/images/01.jpg)">
            <h3>She will say “yes”</h3>
            <h2>engagement ring</h2>
            <a href="/product/7" class="btn-more">Read more</a>
        </li>
        <li class="yellow" style="background-image: url(/images/02.jpg)">
            <h3>You deserve to be beauty</h3>
            <h2>golden bracelets</h2>
            <a href="/category/necklaces" class="btn-more">Read more</a>
        </li>
    </ul>
</div>
<!-- / body -->

<div id="body">
    <div class="container">
        <div class="last-products">
            <h2>Last added products</h2>
            <section class="products">
                <? foreach ($products as $product) { ?>
                <article>
                    <a href="<?=Url::to(['/product/', 'id'=>$product['id']])?>"><img src="/images/<?=$product['photo']?>" alt="<?=$product['title']?>"></a>
                    <h3 style="margin-top: 0"><a href="<?=Url::to(['/product/', 'id'=>$product['id']])?>"><?=$product['title']?></a></h3>
                    <h4 style="padding: 0">
                        <a href="<?=Url::to(['/product/', 'id'=>$product['id']])?>">$<?=$product['price'];?>
                        </a></h4>
                    <? if(!Yii::$app->user->isGuest) { ?> <span style="font-size: 8px">с учетом скидки 10%</span> <? } ?>
                    <a href="/cart/" class="btn-add" data-id="<?=$product['id']?>">Add to cart</a>
                </article>
                <? } ?>
            </section>
        </div>

        <section class="quick-links">
            <article style="background-image: url(/images/2a.jpg)">
                <a href="<?=Url::to(['category/view', 'cat'=>'gift_card'])?>" class="table">
                    <div class="cell">
                        <div class="text">
                            <h4>Подарки</h4>
                            <hr>
                            <h3>На праздники</h3>
                        </div>
                    </div>
                </a>
            </article>
            <article class="red" style="background-image: url(/images/3a.jpg)">
                <a href="<?=Url::to(['category/view', 'cat'=>'new'])?>" class="table">
                    <div class="cell">
                        <div class="text">
                            <h4>друзьям</h4>
                            <hr>
                            <h3>любимым</h3>
                            <hr>
                            <p>близким</p>
                        </div>
                    </div>
                </a>
            </article>
            <article style="background-image: url(/images/4a.jpg)">
                <a href="<?=Url::to(['category/view', 'cat'=>'rings'])?>" class="table">
                    <div class="cell">
                        <div class="text">
                            <h4>свадебные</h4>
                            <hr>
                            <h3>кольца</h3>
                        </div>
                    </div>
                </a>
            </article>
        </section>
    </div>
    <!-- / container -->
</div>
<!-- / body -->

