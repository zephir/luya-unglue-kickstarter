<?php

use luya\Config;

$config = new Config('myproject', dirname(__DIR__), [
    'siteTitle' => 'My Project',
    'defaultRoute' => 'cms',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'luya\admin\Module',
            'interfaceLanguage' => 'en',
            'autoBootstrapQueue' => true, // Enables the fake cronjob by default, read more about queue/scheduler: https://luya.io/guide/app-queue
        ],
        'cms' => [
            'class' => 'luya\cms\frontend\Module',
            'contentCompression' => true,
        ],
        'cmsadmin' => [
            'class' => 'luya\cms\admin\Module',
        ],
    ],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8',
        ],
        'composition' => [
            'hidden' => true, // no languages in your url (most case for pages which are not multi lingual)
            'default' => ['langShortCode' => 'en'], // the default language for the composition should match your default language shortCode in the language table.
        ],
    ],
]);

/************ LOCAL ************/

$config->env(Config::ENV_LOCAL, function (Config $config) {
    $config->callback(function () {
        define('YII_DEBUG', true);
        define('YII_ENV', 'local');
    });

    // docker mysql config
    $config->component('db', [
        'dsn' => 'mysql:host=luya_db;dbname=luya',
        'username' => 'luya',
        'password' => 'luya',
    ]);
    
    $config->component('assetManager', [
        'class' => 'luya\web\AssetManager',
        'linkAssets' => true
    ]);
    
    // debug and gii on local env
    $config->module('debug', [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ]);
    $config->module('gii', [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ]);

    $config->bootstrap(['debug', 'gii']);
});

/************ PROD ************/

$config->env(Config::ENV_PROD, function (Config $config) {
    $config->component('db', [
        'dsn' => 'mysql:host=localhost;dbname=DB_NAME',
        'username' => '',
        'password' => '',
        'enableSchemaCache' => true,
        'schemaCacheDuration' => 0,
    ]);

    $config->component('cache', [
        'class' => 'yii\caching\FileCache'
    ]);
    
    $config->application([
        'ensureSecureConnection' => true, // https://luya.io/guide/app-security
    ]);
});


return $config;
