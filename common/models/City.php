<?php 
namespace common\models;

use Yii;
use yii\base\Model;
use common\models\business\MySql\City as MySql_City;
use common\models\interfaces\BaseInterface;
/**
 * summary
 */
class City extends Model implements BaseInterface
{

	public $id;
	public $cityName;

	// model instance
	protected static $_instance = null;
    /**
     * summary
     */
    public function __construct()
    {

    }

    public static function getInstance()
    {
        //Check instance
    	if (is_null(self::$_instance)) {
    		self::$_instance = new self();
    	}
        //Return instance
    	return self::$_instance;
    }

    public function rules()
    {
    	return [
    		[['cityName'], 'required'],            
    		[['cityName'], 'string', 'max' => 32],
    	];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cityName' => 'Tên thành phố',            
        ];
    }

    public function getAll()
    {
    	$cities = MySql_City::find()->where(['isDeleted' => false])->all();
    	$data = [];
    	foreach ($cities as $key => $value) {
    		$city = new \stdClass();
    		$city = $value->attributes;
    		array_push($data,$city);
    	}
    	return json_decode(json_encode($data), True);

    	// when have redis
    	/*
    	$citiesCache = json_decode(Yii::$app->redis->hget('TestCache','cities'));
    	if (is_null($citiesCache) || (!is_null($citiesCache) && intval(((time() - $citiesCache->time)/60)) > 30)) {
    		$cities = MySql_City::find()->where(['isDeleted' => false])->all();
    		$data = [];
    		foreach ($cities as $key => $value) {
    			$city = new \stdClass();
    			$city = $value->attributes;
    			array_push($data,$city);
    		}
    		$data['time'] = time();
    		Yii::$app->redis->hset('TestCache','cities',json_encode($data));
    		unset($data['time']);
    		echo 'database';
    		return json_decode(json_encode($data), True);
    	}
    	else {           
            //gmt +7
            // $timezone = +7;
            // $time = gmdate('d-m-Y H:i:s',$citiesCache->time + 3600*($timezone));       
    		echo 'cache';
    		unset($citiesCache->time);   
    		return json_decode(json_encode($citiesCache), True);
    	}*/
    }



    /**
     * Finds model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return City the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function getObject($id)
    {
    	if (($model = MySql_City::findOne(['id' => $id,'isDeleted' => false])) !== null) {
    		$this->id = $model->id;
    		$this->cityName = $model->cityname;
    		return $this;
    	}

    	throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function addObject()
    {
    	$model = new MySql_City();
    	$checkExistsRecord = MySql_City::findOne(['cityname' => $this->cityName,'isDeleted' => true]);
    	if ($checkExistsRecord) {
    		$checkExistsRecord->isDeleted = false;
    		$checkExistsRecord->deletedUserId = null;
    		$checkExistsRecord->deletedTime = null;
    		if ($checkExistsRecord->save()) {
    			return true;
    		}
    	}else{
    		$model->cityname = $this->cityName;
    		if ($model->save()) {
    			return true;
    		}
    	}
    }

    public function deleteObject($id)
    {
    	$model = MySql_City::findOne(['id' => $id,'isDeleted' => false]);
    	$model->isDeleted = true;
    	$model->deletedUserId = Yii::$app->user->identity->id;
    	$model->deletedTime = time();
    	return $model->save();
    }

    public function updateObject($id)
    {
    	$model = MySql_City::findOne(['id' => $id,'isDeleted' => false]);
    	$model->cityname = $this->cityName;
    	if ($model->save()) {
    		return true;
    	}    	
    }


}

?>