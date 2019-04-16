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
use frontend\models\CheckoutForm;

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

    public function actionUpdateQuantity()
    {
        $data = $_POST['data'];
        $param = $_POST['param'];
        $currentQuantity = $_POST['currentQuantity'];
        $session = Yii::$app->session;
        $currentData = $session['cart'];
        $totalCart = 0;
        switch ($param) {
            case 'up':
            $data['quantity'] = $_POST['currentQuantity'] + 1;
            $currentData[$data['id']] = $data;
            $session['cart'] = $currentData;
            foreach ($session['cart'] as $key => $item) {
                $totalCart = $totalCart + ((int)$item['quantity'] * (int)$item['pro_price']);
            }
            echo number_format($totalCart).' VNĐ';
            break;
            
            case 'down':
            $data['quantity'] = ($_POST['currentQuantity'] > 1) ? $_POST['currentQuantity'] - 1 : 1;
            $currentData[$data['id']] = $data;
            $session['cart'] = $currentData;
            foreach ($session['cart'] as $key => $item) {
                $totalCart = $totalCart + ((int)$item['quantity'] * (int)$item['pro_price']);
            }
            echo number_format($totalCart).' VNĐ';
            break;      
        }
    }

    public function actionRemoveItemFromCart()
    {
        $id = $_POST['id'];
        $session = Yii::$app->session;
        $currentData = $session['cart'];
        $totalCart = 0;
        unset($currentData[$id]);
        $session['cart'] = $currentData;
        foreach ($session['cart'] as $key => $item) {
            $totalCart = $totalCart + ((int)$item['quantity'] * (int)$item['pro_price']);
        }
        echo number_format($totalCart).' VNĐ';
        die;
    }

    public function actionCheckout()
    {
        $session = Yii::$app->session;
        $model  = new CheckoutForm();
        $currentData = $session['cart'];
        if (!isset($currentData) || count($session['cart']) <= 0) {
            $this->redirect(array('/site/index')); 
        }else{
            return $this->render('checkout',[
                'data' => $currentData,
                'model' => $model
            ]);
        }
    }
}
