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

    public function __construct($verticalModel, $horizontalModels, $searchModels, $value, $link, $content, array $config = [])
    {
        $this->verticalModel = $verticalModel;
        foreach ($horizontalModels as $key => $horizontalModel) {
            $this->models[$key] = new TreeGridModelCell($verticalModel, $horizontalModel, $searchModels, $value,
                $link, $content);
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
