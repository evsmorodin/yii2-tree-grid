<?php

namespace yegorus\treegrid;

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
    public $searchModel;

    public $value;


    public function init()
    {
        if (empty($this->verticalModels) || empty($this->horizontalModels) || empty($this->value)) {
            throw new InvalidConfigException('Empty verticalModels or horizontalModels params');
        }
    }

    public function getModels()
    {
        $models = [];
        foreach ($this->verticalModels as $verticalModel) {
            $models[] = new TreeGridModelRow($verticalModel, $this->horizontalModels, $this->searchModel,
                $this->value);
        }
        return $models;
    }

}