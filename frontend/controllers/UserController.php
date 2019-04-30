<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\SignupForm;
use frontend\models\SearchOrderForm;
use backend\models\Product;
use frontend\models\mysql\Order;
use common\models\User;
use yii\widgets\ActiveForm;
use yii\web\Response;
/**
 * Site controller
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['profile'],
                'rules' => [
                    [
                        'actions' => ['profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            // 'verbs' => [
            //     'class' => VerbFilter::className(),
            //     'actions' => [
            //         'logout' => ['post'],
            //     ],
            // ],
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
    public function actionProfile($id)
    {
        $model = new SignupForm();
        $user = User::findOne($id);
        $attributes = json_decode($user->attributes);
        $model->username = $user->username;
        $model->email = $user->email;
        $model->cmnd = $user->cmnd;
        $model->fullName = $attributes->fullName;
        $model->address = $attributes->address;
        $model->birthYear = $attributes->birthYear;
        if ($model->load(Yii::$app->request->post())) {
            $params = [
                'fullName' => $model->fullName,
                'address' => $model->address,
                'birthYear' => $model->birthYear
            ];
            if (User::updateProfile($id,$params)) {
                return $this->redirect(['/user/profile',
                   'id' => $id,
               ]);
            }
        }
        return $this->render('profile', [
            'model' => $model,
        ]);
    }


    public function actionSearchOrder()
    {
        $model = new SearchOrderForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $data = $model->Search();
                return json_encode($data);
            }else{
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }
        return $this->render('search-order', [
            'model' => $model,
        ]);
    }

}