<?php 
use frontend\widgets\featuresitemsWidget;
use frontend\widgets\categorytabWidget;
use frontend\widgets\recommendeditemsWidget;
use frontend\widgets\categoryWidget;
use frontend\widgets\brandsproductsWidget;
use frontend\widgets\pricerangeWidget;
use frontend\widgets\shippingWidget;
use yii\widgets\Breadcrumbs;
use frontend\widgets\sliderWidget;
use common\widgets\Alert;
?>


<section id="slider"><!--slider-->
	<?= sliderWidget::widget(); ?>
</section><!--/slider-->

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<?= categoryWidget::widget(); ?>	
					<?= brandsproductsWidget::widget(); ?>
					<?= pricerangeWidget::widget();?>
					<?= shippingWidget::widget();?>
				</div>
			</div>

			<div class="col-sm-9 padding-right">
				<?= featuresitemsWidget::widget(); ?>
				<?= recommendeditemsWidget::widget(); ?>
				<?= Breadcrumbs::widget([
					'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
				]) ?>
				<?= Alert::widget()?>
			</div>
		</div>
	</div>
</section>

