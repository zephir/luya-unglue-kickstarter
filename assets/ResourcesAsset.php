<?php

namespace app\assets;

/**
 * Application Asset File.
 */
class ResourcesAsset extends \luya\web\Asset
{
    public $sourcePath = '@app/resources';
    
    public $css = [
        'dist/main.css'
    ];

    public $js = [
        'dist/main.js'
    ];
    
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public $publishOptions = [
        'except' => [
            '*.unglue'
        ]
    ];
}
