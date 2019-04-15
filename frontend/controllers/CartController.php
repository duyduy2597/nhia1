<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use backend\models\Product;

/**
 * Site controller
 */
class CartController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $data = $session['cart'];
        return $this->render('index',[
             'data' => $data
        ]);
    }

    public function actionAddToCart()
    {
        $data = $_POST['data'];
        $session = Yii::$app->session;
      // $session->destroy();die;
        $currentData = $session['cart'];
        $currentData[$data['id']] = $data;

        $session['cart'] = $currentData;
        //var_dump($session['cart']);
        echo count($session['cart']);
        die;
    }
}
