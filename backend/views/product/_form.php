<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Category;
use backend\models\Size;
use backend\models\Color;
use backend\models\Made;
use backend\models\Supplier;
use backend\models\Product;


/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm 
<?= $form->field($model, 'cat_id')->textInput() ?>

    <?= $form->field($model, 'supplier')->textInput() ?>

    <?= $form->field($model, 'pro_size_id')->textInput() ?>

    <?= $form->field($model, 'pro_color_id')->textInput() ?>

    <?= $form->field($model, 'pro_made_id')->textInput() ?>
     <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'complaint')->textarea(['rows' => 6]) ?>
*/
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'pro_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pro_image')->fileInput() ?>

    <?= $form->field($model, 'pro_price')->textInput() ?>

    <?= $form->field($model, 'pro_sale_off')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat_id')->dropDownList(ArrayHelper::map(Category::find()->all(),'cat_id','cat_name'),['prompt'=>'-chọn danh mục-'])?>

   
      <?= $form->field($model, 'supplier')->dropDownList(ArrayHelper::map(Supplier::find()->all(),'sup_id','sup_name'),['prompt'=>'-chọn danh mục-'])?>

    
     <?= $form->field($model, 'pro_size_id')->dropDownList(ArrayHelper::map(Size::find()->all(),'size_id','size_name'),['prompt'=>'-chọn danh mục-'])?>

     <?= $form->field($model, 'pro_color_id')->dropDownList(ArrayHelper::map(Color::find()->all(),'color_id','color_name'),['prompt'=>'-chọn danh mục-'])?>

    
     <?= $form->field($model, 'pro_made_id')->dropDownList(ArrayHelper::map(Made::find()->all(),'made_id','made_name'),['prompt'=>'-chọn danh mục-'])?>
 

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_sale_off')->textInput() ?>

    <?= $form->field($model, 'end_cate_sale')->textInput() ?>

    <?= $form->field($model, 'meta_keyword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>

   
    <?= $form->field($model, 'status')->checkBox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
