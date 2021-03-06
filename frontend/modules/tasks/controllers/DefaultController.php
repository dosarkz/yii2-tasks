<?php

namespace app\modules\tasks\controllers;

use common\models\TasksTypes;
use Yii;
use common\models\Tasks;
use app\models\TasksSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Request;

/**
 * TaskController implements the CRUD actions for Tasks model.
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $tasks_type = Yii::$app->request->get('tasks_type_id');


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tasks_type'   => $tasks_type
        ]);
    }

    /**
     * Displays a single Tasks model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tasks();
        $tasks_types_list = $this->getListTasksTypes();

        $tasks_types_default = TasksTypes::find()->where(['is_default' => true])->one();
        $data = Yii::$app->request->post();

        if (!$tasks_types_default)
        {
            throw new NotFoundHttpException('The default type does not exist.');
        }

        if (isset($_POST['Tasks']['tasks_type_id']) && Yii::$app->request->post('tasks_type_id') == '')
        {
            $data['Tasks']['tasks_type_id'] = $tasks_types_default->id;
        }

        if ($model->load($data) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'tasks_types_list' => $tasks_types_list
            ]);
        }
    }

    /**
     * Updates an existing Tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $tasks_types_list = $this->getListTasksTypes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'tasks_types_list' => $tasks_types_list
            ]);
        }
    }

    protected function getListTasksTypes()
    {
        if (($model = TasksTypes::find()->select(['title','id'])->orderBy('position')->all()) !== null) {
            return $model;
        } else {
            return [];
        }
    }

    /**
     * Deletes an existing Tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
