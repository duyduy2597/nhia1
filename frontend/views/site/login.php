<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container section negative-margin contact">
    <div class="row">
        <div class="col-sm-12">
            <h1><?php echo '<br />'; ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="login-form">
                <!--login form-->
                <h2>Login to your account</h2>
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder' => 'username']) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'password']) ?>

                <div class="form-group field-loginform-rememberme">
                    <div class="checkbox">
                        <label for="loginform-rememberme">
                            <span>
                                <input type="hidden" name="LoginForm[rememberMe]" value="0">
                                <input type="checkbox" class="checkbox" id="loginform-rememberme" name="LoginForm[rememberMe]" value="1" checked=""> 
                                Remember Me
                            </span>
                        </label>
                    </div>
                </div>

                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-default',]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div><!--/login form-->
        </div>
    </div>
</div>

