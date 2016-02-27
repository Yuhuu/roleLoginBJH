<?php

namespace backend\controllers;

use Yii;
use common\models\Student;
use backend\models\StudentCreate;
use backend\models\StudentUpload;
use common\models\StudentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\models\UploadForm;
use yii\web\UploadedFile;
//use phpexcel\Classes\PHPExcel;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
{
    public function behaviors()
    {
        return [
              'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['view', 'index','create','upload','uploadform','update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Student model.
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
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StudentCreate();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()){
                if (Yii::$app->getUser()->login($user)) {
                    Yii::$app->session->setFlash('success', 'You had added an user.');
//                    Yii::$app->session->setFlash('errors', 'Data is registed ');
                }
            }
            else {
                $this->render('create', [
                'model' => $model,
                ]);
                Yii::$app->session->setFlash('errors', 'Data is not registed ');
            }
     }
    return $this->render('create', [
                'model' => $model]);
    }
    
      /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
     public function actionUploadform()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload()) {
                    // file is uploaded successfully
                 Yii::$app->session->setFlash('success', 'You had added USERS file.');
}           return $this->redirect(['upload']);
            }
    return $this->render('upload', ['model' => $model]);
    }
    
       /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

     public function actionUpload()
    {
        $model = new StudentUpload();

        if (Yii::$app->request->isPost) {
                    if ($model->insertData()) {
                    // data is uploaded successfully to db
                    
                    Yii::$app->session->setFlash('success', ' Greate! You had added USERS.');
                    return $this->redirect(['index']);
                    
                    } else {
            
                    Yii::$app->session->setFlash('success', ' Sorry! You had not added any USERS.');
                    }
     }
        return $this->render('readUpload', [
                'model' => $model,
    ]);
    }
    
     /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    
//        public function actionUploadData()
//    {
//        $model = new StudentCreate();
//
//        if ($model->load(Yii::$app->request->post())) {
//            if ($user = $model->signup()){
//                if (Yii::$app->getUser()->login($user)) {
//                    return $this->goHome();
//                }
//            }
//     }
//    return $this->render('create', [
//                'model' => $model,
//    ]);
//    }
    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Student model.
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
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
