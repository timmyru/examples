<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>

<?
//echo "<pre>";
//var_dump(Yii::$app->user->identity);
//echo "</pre>";
//echo "<pre>";
//var_dump($_POST);
//echo "</pre>";
?>


<hr>

    <h1>Личные данные</h1>
<?php if( Yii::$app->session->hasFlash('change') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('change'); ?>
    </div>
<?php endif;?>

<?php if( Yii::$app->session->hasFlash('error') ): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
<?php endif;?>

<?php if( Yii::$app->session->hasFlash('confirmError') ): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('confirmError'); ?>
    </div>
<?php endif;?>
    <form action="/user/change" method="post" style="display: flex; flex-direction: column; align-items: flex-start">
        <input class="input" type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />

        <label for="username">Логин</label>
        <input type="text" required name="username" value="<?=Yii::$app->user->identity['username']?>">
        <label for="username">Имя</label>
        <input type="text" required name="firstname" value="<?=Yii::$app->user->identity['firstname']?>">
        <label for="username">Телефон</label>
        <input type="text" required name="phone" value="<?=Yii::$app->user->identity['phone']?>">
        <label for="username">Адрес</label>
        <input type="text" required name="address" value="<?=Yii::$app->user->identity['address']?>">
        <pre style="display: block; padding: 0">
             <span style="display: block; margin: 0">Изменить пароль</span>
        </pre>
        <label for="password">Старый пароль</label>
        <input type="password" name="oldpassword">
        <label for="newpassword">Новый пароль</label>
        <input type="password" name="newpassword">
        <label for="confirmpassword">Повторить новый пароль</label>
        <input type="password" name="confirmpassword">
        <br>
        <button value="Изменить" class="btn-success btn">Изменить</button>
    </form>

<hr>

<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if( Yii::$app->session->hasFlash('delete') ): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('delete'); ?>
        </div>
    <?php endif;?>

<!--    <p>-->
<!--        --><?//= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'address',
            'phone',
            'email:email',
            'sum',
            ['attribute' => 'status',
                'value' => function($info) {
                    return $info->status=='Завершен' ? "<div style='color: green'>$info->status</div>" : "<div style='color: red'>$info->status</div>";
                },
                'format' => 'raw',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>