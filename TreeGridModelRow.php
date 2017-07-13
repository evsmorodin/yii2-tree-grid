<?php

namespace yegorus\treegrid;

use yii\base\Model;


/**
 * Class TreeGridModel
 * @package yegorus\gridtreeview
 */
class TreeGridModelRow extends Model
{
    public $models;
    public $verticalModel;
    public $searchModel;
    public $horizontalModel = null;

    public function __construct($verticalModel, $horizontalModels, $searchModel, $value, array $config = [])
    {
        $this->verticalModel = $verticalModel;
        $this->searchModel = $searchModel;

        foreach ($horizontalModels as $key => $horizontalModel) {
            $this->models[$key] = new TreeGridModelCell($verticalModel, $horizontalModel, $searchModel, $value);
        }

        parent::__construct($config);
    }

    public function getCell($key)
    {
        return $this->models[$key];
    }

}
