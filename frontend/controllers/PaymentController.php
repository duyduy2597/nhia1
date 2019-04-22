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
        if (!isset($cart) || count($cart) <= 0) {
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
            Yii::$app->session['order-total-price'] = $totalPriceCart;
            Yii::$app->PayPalRestApi->checkOut($params);
        }
    }

    public function actionPaymentSuccess()
    {
        $params = [
            'order' => Yii::$app->session['order-paypal']
        ];
        Yii::$app->PayPalRestApi->processPayment($params);
        $orderModel = new Order();
        $data = Yii::$app->session['cart'];
        $model = Yii::$app->session['order-user-info'];
        $check = $orderModel->createOrder($model,$data,Yii::$app->session['order-total-price'].' USD');
        if ($check['status'] == true) {
            $buyer = Yii::$app->user->identity;
            Yii::$app->session->destroy();
            return $this->redirect(['/order-detail/index', 
                'orderId' => $check['order']['order_id'],
                'cmnd' => !is_null($buyer) ? $buyer['cmnd'] : $model->cmnd]);
        }else{
            return $this->redirect('/');
        }
    }
}
