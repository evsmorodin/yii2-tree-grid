<?php

namespace yegorus\gridtreeview;

use yii\base\Model;


/**
 * Class TreeGridModel
 * @package yegorus\gridtreeview
 */
class TreeGridModelCell extends Model
{
    public $callbackValue;
    public $callbackLink;

    public $searchModels;

    public $verticalModel;
    public $horizontalModel;

    public function __construct($verticalModel, $horizontalModel, $searchModels, $callbackValue, $callbackLink, array $config = [])
    {
        $this->verticalModel = $verticalModel;
        $this->horizontalModel = $horizontalModel;
        $this->callbackValue = $callbackValue;
        $this->callbackLink = $callbackLink;
        $this->searchModels = $searchModels;

        parent::__construct($config);
    }

    public function getValue()
    {
        return call_user_func($this->callbackValue, $this->verticalModel, $this->horizontalModel, $this->searchModels);
    }

    public function getLink()
    {
        return call_user_func($this->callbackValue, $this->verticalModel, $this->horizontalModel, $this->searchModels);
    }

}
