<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?php $urlImage = Yii::getAlias('@web/upload'); ?>

    <img class="img-responsive thumbnail" src="<?php echo $urlImage.'/'.$model->cat_icon ?>" id="imgCategory" alt="<?php echo $model->cat_name ?>">

     <?= $form->field($model, 'cat_icon')->fileInput([
         'onchange' => 'readURL(this, "imgCategory")',
         'value' => $urlImage.'/'.$model->cat_icon,
         'class' => 'form-control',
         'aria-invalid' => 'false'
    ]) ?>

    <?= $form->field($model, 'cat_name')->textInput(['maxlength' => true]) ?>
   
    <?= $form->field($model, 'prent_id')->dropDownList(Arrayhelper::map($parent,'cat_id','cat_name'),['prompt' => '-Muc-']); ?>
        
    <?= $form->field($model, 'meta_keyword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->checkBox() ?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
