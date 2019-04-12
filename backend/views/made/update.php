<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Made */

$this->title = 'Update Made: ' . $model->made_id;
$this->params['breadcrumbs'][] = ['label' => 'Mades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->made_id, 'url' => ['view', 'id' => $model->made_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="made-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
