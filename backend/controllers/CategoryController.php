<?php

namespace backend\controllers;

use Yii;
use backend\models\Category;
use backend\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        $parent = Category::findAll([
            'prent_id' => 0,
        ]);
        if ($model->load(Yii::$app->request->post())) {

            //var_dump('<pre>',$model->prent_id);die;
            if (empty($model->prent_id)) {
                $model->prent_id = 0;
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->cat_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'parent' => $parent
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $parent = Category::findAll([
            'prent_id' => 0,
        ]);
        if ($model->load(Yii::$app->request->post())) {
            //var_dump('<pre>',$model->prent_id);die;
             if (empty($model->prent_id)) {
                $model->prent_id = 0;
            }
            $model->cat_icon = UploadedFile::getInstance($model, 'cat_icon');
            if ($model->cat_icon) {
               $model->cat_icon->saveAs('upload/' . $model->cat_icon->baseName . '.' . $model->cat_icon->extension);
               $model->cat_icon = $model->cat_icon->baseName . '.' . $model->cat_icon->extension;
           }
           if ($model->save()) {
               return $this->redirect(['view', 'id' => $model->cat_id]);
           }
       }

       return $this->render('update', [
        'model' => $model,
        'parent' => $parent
    ]);
   }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
