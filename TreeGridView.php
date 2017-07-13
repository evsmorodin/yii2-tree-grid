<?php

namespace yegorus\treegrid;

use kartik\grid\GridView;
use yii\base\Widget;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;


/**
 * Class FinanceGridView
 * @property array $allColumns
 * @package backend\widgets\grid
 */
class TreeGridView extends Widget
{
    /** @var TreeDataProvider */
    public $treeDataProvider;

    public $contentOptions = [];
    public $content;
    public $url;

    public function run()
    {
        TreeGridAsset::register($this->view);
        return GridView::widget([
            'dataProvider' => new ArrayDataProvider(['allModels' => $this->treeDataProvider->getModels(), 'pagination' => false]),
            'rowOptions' => function ($model){
                return [
                    'style' => ($model->verticalModel->lvl > 0 ? 'display: none;' : ''),
                    'data-lvl' => $model->verticalModel->lvl,
                    'data-id' => $model->verticalModel->id,
                ];
            },
            'striped' => false,
            'columns' => $this->getColumns(),
            'export' => false,
            'showPageSummary' => true,
        ]);
    }

    public function getColumns()
    {
        $columns = [
            [
                'class' => 'kartik\grid\ActionColumn',
                'buttons' => [
                    'visible' => function () {
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-chevron-right js-show-point"></span>', '',
                            ['title' => \Yii::t('yii', 'Раскрыть'), 'data-pjax' => '0']);
                    }
                ],
                'visibleButtons' => [
                    'visible' => function ($model) {
                        return !$model->verticalModel->lvl;
                    },
                ],
                'template'=>'{visible}',
            ],
            [
                'content' => function($model) {
                    return str_repeat('&nbsp;&nbsp;', $model->verticalModel->lvl * 3) .
                        Html::a($model->verticalModel->name, call_user_func($this->url, $model), ['target' => '_blank', 'style' => ['color' => 'inherit']]);
                },
            ]
        ];

        foreach ($this->treeDataProvider->horizontalModels as $key => $horizontalModel) {
            $columns[] = [
                'content' => function($model) use ($key) {
                    return call_user_func($this->content, $model->getCell($key), call_user_func($this->url, $model->getCell($key)));
                },
                'contentOptions' => function($model) use ($key) {
                    return $this->contentOptions ? call_user_func($this->contentOptions, $model->getCell($key)) : [];
                },
                'format' => 'currency',
                'label' => $horizontalModel->name,
                'pageSummary' => 0,
                'pageSummaryOptions' => ['class' => 'js-recalc-sum']
            ];
        }

        return $columns;
    }


}
