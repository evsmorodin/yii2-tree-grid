<?php

namespace yegorus\gridtreeview;

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

    public function run()
    {

        return GridView::widget([
            'dataProvider' => new ArrayDataProvider(['allModels' => $this->treeDataProvider->getModels()]),
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
                        Html::a($model->verticalModel->name, $model->getLink(), ['target' => '_blank', 'style' => ['color' => 'inherit']]);
                },
            ]
        ];

        foreach ($this->treeDataProvider->horizontalModels as $key => $horizontalModel) {
            $columns[] = [
                'content' => function($model) use ($key) {
                    return $model->getCell($key)->value;
                },
                'contentOptions' => function($model) use ($key) {
                    return ['data-val' => (float) $model->getCell($key)->value];
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
