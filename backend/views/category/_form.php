<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Category;
/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm 
<img class="img-responsive thumbnail" src="<?php echo $urlImage.'/'.$model->cat_icon ?>" id="imgCategory" alt="<?php echo $model->cat_name ?>">

     <?= $form->field($model, 'cat_icon')->fileInput([
         'onchange' => 'readURL(this, "imgCategory")',
         'value' => $urlImage.'/'.$model->cat_icon,
         'class' => 'form-control',
         'aria-invalid' => 'false'
    ]) ?>
*/

?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?php $urlImage = Yii::getAlias('@web/upload'); ?>

    
    <?= $form->field($model, 'cat_name')->textInput(['maxlength' => true]) ?>
   
    <?= $form->field($model, 'prent_id')->dropDownList(ArrayHelper::map(Category::getCategories(),'cat_id','cat_name'),['prompt'=>'-chọn danh mục-'])?>
        
    <?= $form->field($model, 'meta_keyword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>
   
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
