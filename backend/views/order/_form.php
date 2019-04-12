<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */
/* @var $form yii\widgets\ActiveForm 
<?= $form->field($model, 'use_id')->textInput(['maxlength' => true]) ?>

 <?= $form->field($model, 'use_name')->textInput(['maxlength' => true]) ?>*/
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'use_id')->dropDownList(ArrayHelper::map(User::find()->all(),'id','id'),['prompt'=>'-chọn danh mục-'])?>

    <?= $form->field($model, 'use_name')->dropDownList(ArrayHelper::map(User::find()->all(),'username','username'),['prompt'=>'-chọn danh mục-'])?>
   

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_ship')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile_ship')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address_ship')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request')->textInput(['maxlength' => true]) ?>

    

    <?= $form->field($model, 'status')->checkBox() ?>

   

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
