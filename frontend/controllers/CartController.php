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
use frontend\models\mysql\Order;

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
        if (is_null($data)) {
           return $this->redirect(array('/'));
       }
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
    if ($totalCart == 0) {
        echo 0;
    }
    else{
        echo number_format($totalCart).' VNĐ';
    }
    die;
}

public function actionCheckoutType()
{
    $session = Yii::$app->session;
    $orderModel = new Order();
    $model  = new CheckoutForm();
    $currentData = $session['cart'];
    if (!isset($currentData) || count($session['cart']) <= 0) {
        return $this->redirect(array('/site/index')); 
    }else{
        if ($model->load(Yii::$app->request->post())) {
            if ($model->checkoutType == 0) {
                Yii::$app->session['order-user-info'] = $model;
                return $this->redirect(['/payment/index']);
            }else{
                $totalCart = 0;
                foreach ($currentData as $key => $item) {
                    $totalCart = $totalCart + ((int)$item['quantity'] * (int)$item['pro_price']);
                }
                $check = $orderModel->createOrder($model,$currentData,number_format($totalCart).' VNĐ');
                if ($check['status'] == true) {
                    $buyer = Yii::$app->user->identity;
                    return $this->redirect(['/order-detail/index','orderId' => $check['order']['order_id'],'cmnd' => !is_null($buyer) ? $buyer['cmnd'] : $model->cmnd ]);
                }
            }
        } else {
            return $this->render('checkout',[
                'data' => $currentData,
                'model' => $model
            ]);
        }
    }
}

public function actionReviewConfirm()
{
    $session = Yii::$app->session;
    $model  = new CheckoutForm();
    $buyer = Yii::$app->user->identity;
    $currentData = $session['cart'];
    if (!isset($currentData) || count($session['cart']) <= 0) {
        $this->redirect(array('/site/index')); 
    }else{
        return $this->render('reviewconfirm',[
         'data' => $currentData,
         'buyer' => $buyer
     ]);
    }
}

public function actionAfterConfirm()
{
    $session = Yii::$app->session;
    $model  = new CheckoutForm();
    $buyer = Yii::$app->user->identity;
    $currentData = $session['cart'];
    if (!isset($currentData) || count($session['cart']) <= 0) {
       return $this->redirect(array('/site/index')); 
   }else{
    if (!Yii::$app->user->isGuest) {    
        $order = new Order();
        $details = [
            'buyer' => [
                'userId' => $buyer['id'],
                'email' => $buyer['email'],
                'username' => $buyer['username'],
                'cmnd' => $buyer['cmnd'],
                'phone' => 1234567,
                'address' => 'Long an',
                'attributes' => $buyer['attributes'],
            ],
            'details' => $currentData
        ];
        $order->use_id = $buyer['id'];
        $order->details = json_encode($details);
        $order->status = 1;
        $order->email = $buyer['email'];
        $order->use_name = $buyer['username'];
        $order->mobile = 123456;
        $order->address = '';
        $order->user_ship = '';
        $order->mobile_ship = '';
        $order->address_ship = '';
        $order->request = '';
        $order->isDeleted = '';
        $order->deletedUserId = 0;
        $order->deletedTime = 0;
        if ($order->save()) {
            return $this->redirect(['/order-detail/index', 'orderId' => $order->order_id]);
        }
    }
}
}

}
