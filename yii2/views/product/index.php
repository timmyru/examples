<?
$this->title = $product['title'];
use yii\helpers\Url;
?>


<div id="body">
    <div class="container">
        <div id="content" class="full">
            <div class="product">
                <div class="image image-pr">
                    <img src="/images/<?=$product['photo']?>" alt="<?=$product['title']?>">
                </div>
                <div class="details">
                    <h1><?=$product['title']?></h1>
                    <h4 style="padding: 0"><a href="<?=Url::to(['/product/', 'id'=>$product['id']])?>">$<?=$product['price'];?></a></h4>
                    <? if(!Yii::$app->user->isGuest) { ?> <span style="font-size: 8px">с учетом скидки 10%</span> <? } ?>
                    <div class="entry">
                        <p><?=$product['descr']?></p>
                        <div class="tabs">
                            <div class="nav">
                                <ul>
                                    <li class="active"><a href="#desc">Description</a></li>
                                    <li><a href="#spec">Specification</a></li>
                                    <li><a href="#ret">Returns</a></li>
                                </ul>
                            </div>
                            <div class="tab-content active" id="desc">
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            </div>
                            <div class="tab-content" id="spec">
                                <p>выsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia ывф sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            </div>
                            <div class="tab-content" id="ret">
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            </div>
                        </div>
                    </div>
                    <div class="actions">
<!--                        <label>Quantity:</label>-->
                        <select id="quantity-select">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <a href="#" data-id="<?=$product['id']?>" class="btn-grey btn-addProduct">Add to cart</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- / content -->
    </div>
    <!-- / container -->
</div>
<!-- / body -->