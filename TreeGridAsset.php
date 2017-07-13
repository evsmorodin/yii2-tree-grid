<?php

namespace yegorus\treegrid;

use yii\web\AssetBundle;

/**
 * Class TreeGridAsset
 * @package yegorus\treegrid
 */
class TreeGridAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';

    public $css = [

    ];
    public $js = [
        'tree-grid.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
