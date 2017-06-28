<?php

namespace yegorus\treegrid;

use yii\base\Model;


/**
 * Class TreeGridModel
 * @package yegorus\gridtreeview
 */
class TreeGridModelCell extends Model
{
    public $value;
    public $content;
    public $link;

    public $searchModels;

    public $verticalModel;
    public $horizontalModel;

    public function __construct($verticalModel, $horizontalModel, $searchModels, $value, $link, $content, array $config = [])
    {
        $this->verticalModel = $verticalModel;
        $this->horizontalModel = $horizontalModel;
        $this->value = $value;
        $this->content = $content;
        $this->link = $link;
        $this->searchModels = $searchModels;

        parent::__construct($config);
    }

    public function getValue()
    {
        return call_user_func($this->value, $this->verticalModel, $this->horizontalModel, $this->searchModels);
    }

    public function getLink()
    {
        return call_user_func($this->link, $this->verticalModel, $this->horizontalModel, $this->searchModels);
    }

    public function getContent()
    {
        return call_user_func($this->content, $this->verticalModel, $this->horizontalModel, $this->searchModels);
    }

}
