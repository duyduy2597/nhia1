<?php 
namespace backend\modules\api\admin\controllers;

use yii\rest\ActiveController;

class CityController extends ActiveController
{
	public $modelClass = 'common\models\City';

	public function behaviors()
	{
		$behaviors = parent::behaviors();
		$behaviors['corsFilter' ] = [
			'class' => \yii\filters\Cors::className(),
		];

		$behaviors['contentNegotiator'] = [
			'class' => \yii\filters\ContentNegotiator::className(),
			'formats' => [
				'application/json' => \yii\web\Response::FORMAT_JSON,
			],
		];

		$behaviors['access'] = [
			'class' => \yii\filters\AccessControl::className(),
			'only' => ['create', 'update', 'delete','index'],
			'rules' => [
				[
					'actions' => ['create', 'update', 'delete','index'],
					'allow' => true,
					'roles' => ['@'],
				],
			],
		];

		return $behaviors;
	}

	public function checkAccess($action, $model = null, $params = [])
	{       	
		if ($action === 'index') {					
			if (\Yii::$app->user->identity->role_id !== 1){
				throw new \yii\web\ForbiddenHttpException(sprintf('You can only %s lease that you\'ve created.', $action));
			}
		}
	}

	public function actions()
	{
		$actions = parent::actions();

    // disable the "delete" and "create" actions
		unset($actions['delete'], $actions['create']);

    // customize the data provider preparation with the "prepareDataProvider()" method
		$actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

		return $actions;
	}

	public function prepareDataProvider()
	{
    	// prepare and return a data provider for the "index" action
		return ["abc" => 'tao đạt nè'];
	}


	public function actionList()
	{
		$model = $this->modelClass;
		$data = $model::Find()->all();
		$result = [];
		foreach ($data as $key => $value) {	
			array_push($result,['id' => $value->id,'cityname' => $value->cityname]);				
		}
		return $result;
	}
}

?>