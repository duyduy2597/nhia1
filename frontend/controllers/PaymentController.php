<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use backend\models\Product;
use frontend\models\mysql\Order;

/**
 * Site controller
 */
class PaymentController extends Controller
{

    public function actionIndex()
    {
        $session = Yii::$app->session;
        $cart = $session['cart'];
        if (!isset($cart) || count($session['cart']) <= 0) {
            return $this->redirect(array('/site/index')); 
        }else{
            $items = [];
            $totalPriceCart = 0;
            foreach ($cart as $key => $obj) {
                $priceDollar = (int)($obj['pro_price']/Yii::$app->params['priceDollar']);
                $totalPriceCart += $priceDollar*(int)$obj['quantity'];
                $item = [
                    'name' => $obj['pro_name'],
                    'price' => (int)$priceDollar,
                    'quantity' => (int)$obj['quantity'],
                    'currency' => 'USD'
                ];
                $items[] = $item;
            }
            $params = [
                'method'=>'paypal',
                'intent'=>'sale',
                'order'=>[
                    'description'=>'NHỌ NHÍA SHOP-THANH TOÁN MUA HÀNG',
                    'subtotal'=> (int)$totalPriceCart,
                    'shippingCost' => 0,
                    'total' => (int)$totalPriceCart,
                    'currency'=>'USD',
                    'items'=> $items
                ]
            ];
            Yii::$app->session['order-paypal'] = $params['order'];
            Yii::$app->PayPalRestApi->checkOut($params);
        }
    }

    public function actionPaymentSuccess()
    {
        $params = [
            'order' => Yii::$app->session['order-paypal']
        ];
        Yii::$app->PayPalRestApi->processPayment($params);
        $data = Yii::$app->session['cart'];
        Yii::$app->session->destroy();
        return $this->render('payment-success',[
           'data' => $data,
       ]);
    }
}
