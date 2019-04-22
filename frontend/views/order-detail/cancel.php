<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'HỦY ĐƠN ĐẶT HÀNG';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container section negative-margin contact">
    <div class="row">
        <div class="col-sm-12">
            <h1><?php echo '<br />'; ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="login-form">
                <!--login form-->
                <h2><?php echo $this->title; ?></h2>
                <?php $form = ActiveForm::begin(['id' => 'cancel-order-form']); ?>

                <?= $form->field($model, 'secretKey')->textInput(['autofocus' => true,'placeholder' => 'Nhập mã đặt hàng']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Cancel', ['class' => 'btn btn-default',]) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div><!--/login form-->
        </div>
    </div>
</div>

