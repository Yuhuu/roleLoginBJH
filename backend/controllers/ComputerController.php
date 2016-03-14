<?php //

//namespace backend\controllers;
//
//use Yii;
//use common\models\Computer;
//use common\models\ComputerSearch;
//use yii\web\Controller;
//use yii\web\NotFoundHttpException;
//use yii\filters\VerbFilter;


namespace backend\controllers;

use yii\rest\ActiveController;

/**
 * StudentEquipmentController implements the CRUD actions for StudentEquipment model.
 */
class ComputerController extends ActiveController
{
    //  the model class equipment to fetching data 
    public $modelClass = 'common\models\Computer';
        //  the cors behavior to grant access to third party code 
        public function behaviors()
        {
        return 
        \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
            ],
        ]);
    }
}
     
/**
 * ComputerController implements the CRUD actions for Computer model.
 */
//class ComputerController extends Controller
//{
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['post'],
//                ],
//            ],
//        ];
//    }
//
//    /**
//     * Lists all Computer models.
//     * @return mixed
//     */
//    public function actionIndex()
//    {
//        $searchModel = new ComputerSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }
//
//    /**
//     * Displays a single Computer model.
//     * @param string $id
//     * @return mixed
//     */
//    public function actionView($id)
//    {
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
//    }
//
//    /**
//     * Creates a new Computer model.
//     * If creation is successful, the browser will be redirected to the 'view' page.
//     * @return mixed
//     */
//    public function actionCreate()
//    {
//        $model = new Computer();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->serial_id]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
//    }
//
//    /**
//     * Updates an existing Computer model.
//     * If update is successful, the browser will be redirected to the 'view' page.
//     * @param string $id
//     * @return mixed
//     */
//    public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->serial_id]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }
//    }
//
//    /**
//     * Deletes an existing Computer model.
//     * If deletion is successful, the browser will be redirected to the 'index' page.
//     * @param string $id
//     * @return mixed
//     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }
//
//    /**
//     * Finds the Computer model based on its primary key value.
//     * If the model is not found, a 404 HTTP exception will be thrown.
//     * @param string $id
//     * @return Computer the loaded model
//     * @throws NotFoundHttpException if the model cannot be found
//     */
//    protected function findModel($id)
//    {
//        if (($model = Computer::findOne($id)) !== null) {
//            return $model;
//        } else {
//            throw new NotFoundHttpException('The requested page does not exist.');
//        }
//    }
//}
