<?php
$config = [
    'id' => 'webassistant',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'app\commands',
];

if (YII_DEBUG) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;
