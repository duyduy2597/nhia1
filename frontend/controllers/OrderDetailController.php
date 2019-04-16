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
use frontend\models\mysql\Order;
/**
 * Site controller
 */
class OrderDetailController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index',],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
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
    public function actionIndex($orderId)
    {
        $session = Yii::$app->session;
        $session['cart'] = [];
        $order = Order::findOne($orderId);
        if ($order['use_id'] != Yii::$app->user->identity->id) {
            return $this->redirect(array('/site/index')); 
        }
        return $this->render('index',[
           'data' => $session['cart'],
           'orderDetail' => $order->attributes
       ]);
    }

    public function actionCancelOrder($orderId)
    {
        $order = Order::findOne($orderId);
        if ($order['status'] == 1) {
            $order->status = 0;
            if ($order->save()) {
                return $this->redirect(['/order-detail/index', 'orderId' => $orderId]);
            }
        }else{
            throw new BadRequestHttpException('Đầu vào không hợp lệ !');
        }
    }

}
