<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Made */

$this->title = 'Create Made';
$this->params['breadcrumbs'][] = ['label' => 'Mades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="made-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
