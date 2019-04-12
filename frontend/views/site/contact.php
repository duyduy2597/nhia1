<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container section negative-margin contact">
    
    <div class="row">
        <div class="col-sm-12">
            <h1><?php echo '<br />'; ?></h1>
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-12">
            <h2><?php echo $this->title; ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <form>
                <div class="form-group">
                    <label>Name *</label>
                    <input type="text">
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email">
                </div>
                <div class="form-group">
                    <label>Where did you hear about us?</label>
                    <input type="text">
                </div>
                <div class="form-group">
                    <label>Message *</label>
                    <textarea rows="5"></textarea>
                </div>
                <div class="form-group right-align">
                    <button class="btn btn-ghost">Send message</button>
                </div>
            </form>
        </div>
        <div class="col-sm-5 col-sm-push-1">
            <div class="icon-row">
                <div class="col">
                    <span class="circle">
                        <i class="material-icons">place</i>
                    </span>
                </div>
                <div class="col">
                    <h4 class="no-underline">Address</h4>
                    <p>342 Sloane St, London, W1D 3NE</p>
                </div>
            </div>
            <div class="icon-row">
                <div class="col">
                    <span class="circle">
                        <i class="material-icons">email</i>
                    </span>
                </div>
                <div class="col">
                    <h4 class="no-underline">Email</h4>
                    <p><a href="https://www.klevermedia.co.uk/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="7d14131b123d10120b14180e091c0f531e12530816">[email&nbsp;protected]</a></p>
                </div>
            </div>
            <div class="icon-row">
                <div class="col">
                    <span class="circle">
                        <i class="material-icons">phone in talk</i>
                    </span>
                </div>
                <div class="col">
                    <h4 class="no-underline">Telephone</h4>
                    <p>+44 0330 123 4567</p>
                </div>
            </div>
        </div>
    </div>
</div>
