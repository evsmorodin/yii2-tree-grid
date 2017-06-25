<?php

namespace yegorus\gridtreeview;

use yii\base\Model;


/**
 * Class TreeGridModel
 * @package yegorus\gridtreeview
 */
class TreeGridModelRow extends Model
{
    public $models;
    public $verticalModel;

    public function __construct($verticalModel, $horizontalModels, $searchModels, $callbackValue, $callbackLink, array $config = [])
    {
        $this->verticalModel = $verticalModel;
        foreach ($horizontalModels as $key => $horizontalModel) {
            $this->models[$key] = new TreeGridModelCell($verticalModel, $horizontalModel, $searchModels, $callbackValue,
                $callbackLink);
        }

        parent::__construct($config);
    }

    public function getLink()
    {
        return '';
    }

    public function getCell($key)
    {
        return $this->models[$key];
    }

}
