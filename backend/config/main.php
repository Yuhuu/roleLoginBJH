<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
//         'request' => [
//            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
//            'cookieValidationKey' => 'x6tjpI4ZMSaasW0-pamgdcCzrMWcFpgl',
//            'parsers' => [
//                'application/json' => 'yii\web\JsonParser',
//            ],
//        ],
        
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
            'urlManager' => [
            'enablePrettyUrl' => true,
            //for security reasons, better enableStrictParsing to see what is exposed to the public.
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
             [  
                'class' => 'yii\rest\UrlRule', 
                'controller' => 'student'                    
             ],
                [  
                'class' => 'yii\rest\UrlRule', 
                'controller' => 'student_equipment'                    
             ],
                [  
                'class' => 'yii\rest\UrlRule', 
                'controller' => 'equipment'                   
             ], 
                 
            ],
        ],
    ],
    'params' => $params,
];
