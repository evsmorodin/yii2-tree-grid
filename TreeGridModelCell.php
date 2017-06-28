<?php

namespace yegorus\treegrid;

use common\traits\ModelCacheTrait;
use yii\base\Model;


/**
 * Class TreeGridModel
 * @package yegorus\gridtreeview
 */
class TreeGridModelCell extends Model
{
    use ModelCacheTrait;

    public $callbackValue;
    public $callbackContent;
    public $callbackLink;

    public $searchModel;

    /** @var object */
    public $verticalModel;
    public $horizontalModel;

    public function __construct($verticalModel, $horizontalModel, $searchModel, $callbackValue, $callbackLink, $callbackContent, array $config = [])
    {
        $this->verticalModel = $verticalModel;
        $this->horizontalModel = $horizontalModel;
        $this->callbackValue = $callbackValue;
        $this->callbackContent = $callbackContent;
        $this->callbackLink = $callbackLink;
        $this->searchModel = $searchModel;

        parent::__construct($config);
    }

    public function getValue()
    {
        return $this->cachedGet(__METHOD__ . $this->verticalModel->id . $this->horizontalModel->id . serialize($this->searchModel), function () {
            return call_user_func($this->callbackValue, $this);
        });
    }

    public function getUrl()
    {
        return $this->cachedGet(__METHOD__ . $this->verticalModel->id . $this->horizontalModel->id . serialize($this->searchModel), function () {
            return call_user_func($this->callbackLink, $this);
        });
    }

    public function getContent()
    {
        return $this->cachedGet(__METHOD__ . $this->verticalModel->id . $this->horizontalModel->id . serialize($this->searchModel), function () {
            return call_user_func($this->callbackContent, $this);
        });
    }

}
