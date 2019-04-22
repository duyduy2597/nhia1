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
use frontend\models\CancelForm;
/**
 * Site controller
 */
class OrderDetailController extends Controller
{
    /**
     * {@inheritdoc}
     */
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'only' => ['index',],
    //             'rules' => [
    //                 [
    //                     'actions' => ['index'],
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                 ],
    //             ],
    //         ],
    //     ];
    // }
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
    public function actionIndex($orderId,$cmnd)
    {   
        $session = Yii::$app->session;
        $session['cart'] = [];
        $order = Order::findOne([
            'order_id' => $orderId,'cmnd' => $cmnd]);
        if (is_null($order)) {
            return $this->redirect(array('/site/index')); 
        }
        return $this->render('index',[
           'data' => $session['cart'],
           'orderDetail' => $order
       ]);
    }
    public function actionCancelOrder($orderId)
    {
        $model = new CancelForm();
        if ($model->load(Yii::$app->request->post())) {
            $order = Order::findOne($orderId);
            $check = $model->checkValidateSecretKey($order->secretkey);
            if ($check) {
                $order->status = 0;
                if ($order->save()) {
                    return $this->redirect(['/order-detail/index',
                       'orderId' => $orderId,
                       'cmnd' => $order->cmnd]);
                }
            }else{
                return $this->render('cancel',[
                    'model' => $model
                ]);
            }
        }
        return $this->render('cancel',[
            'model' => $model
        ]);
    }
}