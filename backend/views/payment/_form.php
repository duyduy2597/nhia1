<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Payment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'payment_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_id')->textInput() ?>

    <?= $form->field($model, 'isDeleted')->textInput() ?>

    <?= $form->field($model, 'deletedUserId')->textInput() ?>

    <?= $form->field($model, 'deletedTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
