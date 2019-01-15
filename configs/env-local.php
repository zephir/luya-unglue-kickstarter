<?php

/**
 * This is the base config. It doesn't hold any informations about the database and is only used for local development.
 * Use env-local-db.php to configure you database.
 */

/*
 * Enable or disable the debugging, if those values are deleted YII_DEBUG is false and YII_ENV is prod.
 * The YII_ENV value will also be used to load assets based on environment (see assets/ResourcesAsset.php)
 */
defined('YII_ENV') or define('YII_ENV', 'local');
defined('YII_DEBUG') or define('YII_DEBUG', true);

$config = [
    'id' => 'myproject',
    'siteTitle' => 'My Project',
    'defaultRoute' => 'cms',
    'basePath' => dirname(__DIR__),
    'modules' => [
        'admin' => [
            'class' => 'luya\admin\Module',
            'interfaceLanguage' => 'en',
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
        'composition' => [
            'hidden' => true, // no languages in your url (most case for pages which are not multi lingual)
            'default' => ['langShortCode' => 'en'], // the default language for the composition should match your default language shortCode in the language table.
        ],
        'cache' => [
            'class' => 'yii\caching\DummyCache', // use: yii\caching\FileCache
        ],
    ],
];

if (YII_DEBUG) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = ['class' => 'yii\debug\Module', 'allowedIPs' => ['*']];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = ['class' => 'yii\gii\Module', 'allowedIPs' => ['*']];
}

return \yii\helpers\ArrayHelper::merge($config, require('env-local-db.php'));
