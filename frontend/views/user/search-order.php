<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Search Order';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container section negative-margin contact">
	<div class="row">
		<div class="col-sm-12">
			<h1><?php echo '<br />'; ?></h1>
		</div>
	</div>  
	<div class="row">
		<div class="col-sm-6">
			<?php $form = ActiveForm::begin([
				'id' => 'form-search-order',
				'enableAjaxValidation' => true,
			]); ?>

			<?= $form->field($model, 'email') ?>         

			<div class="form-group">
				<?= Html::submitButton('Search', ['class' => 'btn btn-ghost', 'id' => 'searchOrderBtn']) ?>
			</div>

			<?php ActiveForm::end(); ?>
		</div>
	</div>
	<div class="row">
		
	</div>
</div>
