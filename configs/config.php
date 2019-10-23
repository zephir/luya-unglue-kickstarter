<?php

use luya\Config;

$config = new Config('myproject', dirname(__DIR__), [
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

// database config for 
$config->component('db', [
    'dsn' => 'mysql:host=localhost;dbname=DB_NAME',
    // 'dsn' => 'mysql:host=localhost;dbname=DB_NAME;unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock', // OSX MAMP
    // 'dsn' => 'mysql:host=localhost;dbname=DB_NAME;unix_socket=/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock', // OSX XAMPP
    'username' => '',
    'password' => '',
])->env(Config::ENV_LOCAL);

/*
// docker mysql config
$config->component('db', [
    'dsn' => 'mysql:host=luya_db;dbname=luya_unglue_kickstarter',
    'username' => 'luya',
    'password' => 'CHANGE_ME',
])->env(Config::ENV_LOCAL);
*/

$config->component('db', [
    'dsn' => 'mysql:host=localhost;dbname=DB_NAME',
    'username' => '',
    'password' => '',
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 0,
])->env(Config::ENV_PROD);

$config->component('cache', [
    'class' => 'yii\caching\FileCache'
])->env(Config::ENV_PROD);

// debug and gii on local env
$config->module('debug', [
    'class' => 'yii\debug\Module',
    'allowedIPs' => ['*'],
])->env(Config::ENV_LOCAL);
$config->module('gii', [
    'class' => 'yii\gii\Module',
    'allowedIPs' => ['*'],
])->env(Config::ENV_LOCAL);

$config->bootstrap(['debug', 'gii'])->env(Config::ENV_LOCAL);

return $config;
