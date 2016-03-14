<?php
use yii\rest\Controller;
use common\models\LoginForm;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;
/*\
 * Copyright(C) 2016.  All rights reserved to Bjørnholt school. 
 * https://bjornholt.osloskolen.no/
 * @author Created by Bachelor Final Project group 18 at Oslo and Akershus University College 
 * Creating interactive web pages using the Angualr framework carried out by:
 * Martin Hansen Muren Mathisen (s189116), Waqas Liaqat (s180364), 
 * Yuanxin Huang (s184519), Thanh Nguyen Chu (s169954)
 * @version 1.01.01
 */

/**
 * Api controller
 */
class ApiController extends Controller {
    //put your code here
//    want to keep the behaviors() configuration from yii\rest\Controller
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
        'class' => HttpBearerAuth::className(),
        'only' => ['dashboard'],
    ];
        $behaviors['contentNegotiator'] = [
        'class' => ContentNegotiator::className(),
        'formats' => [
            'application/json' => Response::FORMAT_JSON,
        ],
    ];
        // this handle access control
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['dashboard'],
            'rules' => [
                [
                    'actions' => ['dashboard'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];
        return $behaviors;
    }
    
     public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            return ['access_token' => Yii::$app->user->identity->getAuthKey()];
        } else {
            $model->validate();
            return $model;
        }
    }
    
    public function actionDashboard()
    {
        $response = [
            'username' => Yii::$app->user->identity->username,
            'access_token' => Yii::$app->user->identity->getAuthKey(),
        ];

        return $response;
    }
}
