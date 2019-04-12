<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Deliver */

$this->title = 'Update Deliver: ' . $model->del_id;
$this->params['breadcrumbs'][] = ['label' => 'Delivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->del_id, 'url' => ['view', 'id' => $model->del_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="deliver-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
