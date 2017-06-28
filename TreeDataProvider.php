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
    public $url;
    public $content;


    public function init()
    {
        if (empty($this->verticalModels) || empty($this->horizontalModels) || empty($this->value)) {
            throw new InvalidConfigException('Empty verticalModels or horizontalModels params');
        }

        $this->url = ArrayHelper::getValue($this, 'url',
            function ($model) {
                return '';
            });
        $this->content = ArrayHelper::getValue($this, 'content', $this->value);
    }

    public function getModels()
    {
        $models = [];
        foreach ($this->verticalModels as $verticalModel) {
            $models[] = new TreeGridModelRow($verticalModel, $this->horizontalModels, $this->searchModel,
                $this->value, $this->url, $this->content);
        }
        return $models;
    }

}