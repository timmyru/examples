<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Заказ №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назад', ['/user/'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <? if (Yii::$app->user->identity['username']=='admin') { ?>

        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

        <? } ?>
    </p>

    <hr>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'address',
            'phone',
            'email:email',
            'sum',
            'status',
        ],
    ]) ?>


    <?
    $goods = $model->orderGoods;
    foreach ($goods as $good) { ?>
        <div>-<?=$good['name']?> в количестве <?=$good['quantity']?>шт на сумму <?=$good['sum']?> рублей</div>
    <? }
    ?>

</div>
