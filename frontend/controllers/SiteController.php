<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\CommentForm;
use backend\models\Product;
use frontend\models\mysql\Order;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
    public function actionIndex()
    {
        $data = Product::findAll(['isDeleted' => 0]);
        $arrProduct = [];
        foreach ($data as $value) {
            $arrProduct[$value['pro_id']] = $value->attributes;
        }
        return $this->render('index',[
            'arrProduct' => $arrProduct
        ]);
    }

    public function actionDetailProduct($id)
    {
        $product = Product::findOne($id);
        $product = $product->attributes;
        
        $relationProduct = Product::find()->all();
        $arrProduct = [];
        foreach ($relationProduct as $key => $pro) {
            $arrProduct[$pro['pro_id']] = $pro->attributes;
        }
        unset($arrProduct[$product['pro_id']]);
        $model = new CommentForm();
        if ($model->load(Yii::$app->request->post())) {
            $user = $model->validateByEmail();
            if ($user != false) {
                $data = $model->createComment($user,$id);
                if ($data != false) {
                    return $this->redirect(['/site/detail-product',
                     'id' => $id,
                 ]);
                }
            }else{
                return $this->render('detail-product',[
                    'productDetail' => $product,
                    'model' => $model,
                    'relationProduct' => $arrProduct,
                ]);
            }
        }
        return $this->render('detail-product',[
            'productDetail' => $product,
            'model' => $model,
            'relationProduct' => $arrProduct,
        ]);
    }

    public function actionLoadMoreComment()
    {
        $product = Product::findOne($_GET['id']);
        $product = $product->attributes;
        $arrComment = json_decode($product['comment'],true);
        $arrComment = $arrComment ? $arrComment : [];
        if ($arrComment) {
            $arrComment = array_reverse($arrComment);
            $arrComment = array_slice($arrComment, $_GET['offset'],$_GET['limit']);
            foreach ($arrComment as & $comment) {
                $time = (time() - (int)$comment['creation_time']);
                $checkTime = round($time);
                if ($time/86400 >= 1) {
                    $comment['display_time_comment'] = date("d-m-Y H:i:s",$comment['creation_time']);         
                }
                else{
                    $minutes = $time/60;
                    if (round($minutes) >= 60) {
                        if (round($minutes/60) == 1) {
                            $comment['display_time_comment'] = round($minutes/60) . ' hour ago';
                        }else{
                            $comment['display_time_comment'] = round($minutes/60) . ' hours ago';
                        }
                    }else{
                        $second = $minutes * 60;
                        if (round($second) < 60) {
                            $comment['display_time_comment'] = round($second) . ' seconds ago';
                        }
                        else{
                            $comment['display_time_comment'] = round($minutes) . ' min ago';
                        }
                    }
                }
            }
        }
        $dataReturn = [
            'status' => true,
            'data' => []
        ];
        if (count($arrComment) < $_GET['limit']) {
            $dataReturn['status'] = false;
        }
        $dataReturn['data'] = $arrComment;
        echo json_encode($dataReturn);
        die;
    }

    public function actionAddToCart()
    {
        $data = $_POST['data'];
        $session = Yii::$app->session;
      // $session->destroy();die;
        $currentData = $session['cart'];
        $currentData[$data['id']] = json_encode($data);

        $session['cart'] = $currentData;
        //var_dump($session['cart']);
        echo count($session['cart']);
        die;
    }
    
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin($cancel = false)
    {
        if (!Yii::$app->user->isGuest && $cancel == false) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if ($cancel != false) {
                $dataCancel = json_decode($cancel,true);
                if (Yii::$app->user->identity->cmnd == $dataCancel['cmnd']) {
                    $order = Order::findOne($dataCancel['order_id']);
                    var_dump($order);die;
                    $order->status = 0;
                    if ($order->save()) {
                        return $this->redirect(['/order-detail/index',
                         'orderId' => $orderId,
                         'cmnd' => $dataCancel['cmnd']
                     ]);
                    }
                }else{
                    throw new ForbiddenHttpException('Bạn không được quyền thực hiện hành động này, ok!');
                }
            }
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {      
        //$test = file_get_contents("http://datdat.local:90/api/city/list");  
        $ch = curl_init("http://datdat.local:90/cities");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);             
        var_dump(json_decode($data));
        //return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
