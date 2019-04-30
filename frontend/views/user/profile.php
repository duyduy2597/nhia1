<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'THÔNG TIN TÀI KHOẢN';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container section negative-margin contact">
    <div class="row">
        <div class="col-sm-12">
            <h1><?php echo '<br />'; ?></h1>
        </div>
    </div>  
    <div class="row">
        <div class="col-sm-12">
            <h2>THÔNG TIN TÀI KHOẢN</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true,'disabled' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['disabled' => true]) ?>

            <?= $form->field($model, 'cmnd')->textInput(['disabled' => true]) ?>   

            <?= $form->field($model, 'fullName') ?>

            <?= $form->field($model, 'address') ?> 

            <?= $form->field($model, 'birthYear') ?>           

            <div class="form-group">
                <?= Html::submitButton('Update', ['class' => 'btn btn-ghost', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
