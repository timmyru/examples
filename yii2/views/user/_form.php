<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <? if (Yii::$app->user->identity['username'] == 'admin') { ?>
    <?= $form->field($model, 'status')->dropDownList(['Новый' => 'Новый', 'Завершен' => 'Завершен']) ?>
    <? } ?>

    <!--    --><?//= $form->field($model, 'sum')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
