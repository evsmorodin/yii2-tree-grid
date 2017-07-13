<?php

namespace yegorus\treegrid;

use yii\base\Model;


/**
 * Class TreeGridModel
 * @package yegorus\gridtreeview
 */
class TreeGridModelCell extends Model
{
    use ModelCacheTrait;

    public $callbackValue;

    public $searchModel;

    /** @var object */
    public $verticalModel;
    public $horizontalModel;

    public function __construct($verticalModel, $horizontalModel, $searchModel, $callbackValue, array $config = [])
    {
        $this->verticalModel = $verticalModel;
        $this->horizontalModel = $horizontalModel;
        $this->callbackValue = $callbackValue;
        $this->searchModel = $searchModel;

        parent::__construct($config);
    }

    public function getValue()
    {
        return $this->cachedGet(md5(__METHOD__ . $this->verticalModel->id . $this->horizontalModel->id . serialize($this->searchModel)), function () {
            return call_user_func($this->callbackValue, $this);
        });
    }
}
