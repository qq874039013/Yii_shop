<?php
return [
    'modules' => [
        'rbac' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
        ]
    ],
    'components' => [
        'authManager' => [
    'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
    ],],
    'as access' => [
    'class' => 'mdm\admin\components\AccessControl',
//        放行的路由
    'allowActions' => [
        'rbac/*',
        'admin/*',
        'menu/*',
        'brand/*',
        'goods/*',
        'article/*',
        'some-controller/some-action',
        // The actions listed here will be allowed to everyone including guests.
        // So, 'admin/*' should not appear here in the production, of course.
        // But in the earlier stages of your development, you may probably want to
        // add a lot of actions here until you finally completed setting up rbac,
        // otherwise you may not even take a first step.
    ]
],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
//    'components' => [
//        'cache' => [
//            'class' => 'yii\caching\FileCache',
//        ],
//        'authManager' => [
//            'class' => 'yii\rbac\DbManager',
//        ],
//    ],
];
