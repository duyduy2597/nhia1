<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Product;
use backend\models\Order;
/* @var $this yii\web\View */
/* @var $model backend\models\Orderdetail */
/* @var $form yii\widgets\ActiveForm <?= $form->field($model, 'order_id')->textInput() ?>
<?= $form->field($model, 'pro_price')->textInput() ?>*/
?>

<div class="orderdetail-form">

    <?php $form = ActiveForm::begin(); ?>
     <?= $form->field($model, 'order_id')->dropDownList(ArrayHelper::map(Order::find()->all(),'order_id','order_id'),['prompt'=>'-chọn danh mục-'])?>

    <?= $form->field($model, 'pro_id')->dropDownList(ArrayHelper::map(Product::find()->all(),'pro_id','pro_name'),['prompt'=>'-chọn danh mục-'])?>
    <?= $form->field($model, 'pro_price')->dropDownList(ArrayHelper::map(Product::find()->all(),'pro_price','pro_price'),['prompt'=>'-chọn danh mục-'])?>

    

    <?= $form->field($model, 'pro_amount')->textInput() ?>

    <?= $form->field($model, 'status')->checkBox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
