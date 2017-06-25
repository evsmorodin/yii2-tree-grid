<?php

namespace yegorus\gridtreeview;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * @inheritdoc
 */
class TreeDataProvider extends Model
{
    public $verticalModels;
    public $horizontalModels;
    public $searchModels;

    public $callbackValue;
    public $callbackLink;


    public function init()
    {
        if (empty($this->verticalModels) || empty($this->horizontalModels) || empty($this->callbackValue)) {
            throw new InvalidConfigException('Empty verticalModels or horizontalModels params');
        }

        $this->callbackLink = ArrayHelper::getValue($this, 'callbackLink',
            function ($verticalModel, $horizontalModel, $searchModel) {
                return '';
            });
    }

    public function getModels()
    {
        $models = [];
        foreach ($this->verticalModels as $verticalModel) {
            $models[] = new TreeGridModelRow($verticalModel, $this->horizontalModels, $this->searchModels,
                $this->callbackValue, $this->callbackLink);
        }
        return $models;
    }
}