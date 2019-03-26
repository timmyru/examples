<?
$this->title = 'Корзина';
?>


<div id="body">
    <hr style="margin-bottom: 40px">

    <div class="container">
        <div id="content" class="full">
            <? if (isset($session['cart']) && $session['cart.totalSum'] > 0) { ?>
            <div class="cart-table">
                <table>
                    <tr>
                        <th class="items">Items</th>
                        <th class="price">Price</th>
                        <th class="qnt">Quantity</th>
                        <th class="total">Total</th>
                        <th></th>
                    </tr>

                    <?   foreach ($session['cart'] as $id=>$good) { ?>
                        <? if (!Yii::$app->user->isGuest) {$good['price'] *= 0.9;}?>
                    <tr>

                        <td class="items">
                            <div class="image">
                                <img src="/images/<?=$good['photo']?>" alt="<?=$good['title']?>">
                            </div>
                            <h3><a href="#"><?=$good['title']?></a></h3>
                            <p><?=$good['descr']?></p>
                        </td>
                        <td class="price">$<?=$good['price']?></td>
                        <td class="qnt">
                            <select style="height: 40px;
                            line-height: 36px;
                            padding: 0 40px 0 10px;
                            color: #656567;
                            font-size: 12px;
                            font-weight: 500;
                            border: 1px solid #cdcdcd;
                            background-color: #fff;
                            position: relative;
                            display: block;
                            cursor: pointer;"
                            data-id="<?=$id?>" name="cart-select" id="cart-select">
                                <? if ($good['quantity'] > 5) {
                                        for ($i=1; $i <= $good['quantity']; $i++) {?>
                                <option value="<?=$i?>" <? if ($i==$good['quantity']) {echo 'selected';}?>><?=$i?></option>
                                <? } } else {
                                    for ($i=1; $i<6; $i++) { ?>
                                    <option value="<?=$i?>" <? if ($i==$good['quantity']) {echo 'selected';}?>><?=$i?></option>
                                <? }} ?>
                            </select>
                        <td class="total">$<?=$good['price']*$good['quantity']?></td>
                        <td class="delete" data-id="<?=$id?>"><a href="#" class="ico-del"></a></td>

                    </tr>
                    <? } ?>

                </table>
            </div>


            <div class="total-count">
<!--                <h4>Subtotal: $4 500.00</h4>-->
<!--                <p>+shippment: $30.00</p>-->
                <form action="/cart/success" method="POST" style="display: flex; flex-direction: column">
                    <input class="input" type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                    <input class="input" type="text" required name="username" placeholder="Ваше имя" value="<?=Yii::$app->user->identity['username']?>">
                    <input class="input" type="email" required name="email" placeholder="Email" value="<?=Yii::$app->user->identity['email']?>" <? if (isset(Yii::$app->user->identity['email'])) { ?> readonly style={background:#ccc}<?}?>>
                    <input class="input" type="text" required name="phone" placeholder="Телефон" value="<?=Yii::$app->user->identity['phone']?>">
                    <input class="input" type="text" required name="address" placeholder="Адрес" value="<?=Yii::$app->user->identity['address']?>">
                <h3>Total to pay: $<strong class="totalSum"><?=$session['cart.totalSum']?></strong></h3>
                    <h4 class="totalQ" style="display: none"><?=$session['cart.totalQuantity']?></h4>
                <input type="submit" style="text-align: center; cursor: pointer; text-transform: uppercase; border: none; font-size: 20px" class="btn-grey" value="Отправить заказ">
                </form>
            </div>

              <?  } else { ?>
                <div>Ваша корзина пуста</div>
            <? } ?>

        </div>
        <!-- / content -->
    </div>
    <!-- / container -->
</div>
<!-- / body -->
