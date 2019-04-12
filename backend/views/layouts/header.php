<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
Yii::$app->name = "WOW NHÍA";
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <?= '<li style= "padding-top:9px;">'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton('Logout <span class="fa fa-sign-out " aria-hidden="true"></span>',['class' => 'btn btn-primary'])
                . Html::endForm()
                . '</li>' ?>                      
            </ul>
        </div>
    </nav>
</header>
