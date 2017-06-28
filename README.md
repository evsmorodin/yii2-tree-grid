Grid Tree View
==============
Grid Tree View

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yegorus/yii2-tree-grid "*"
```

or add

```
"yegorus/yii2-tree-grid": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?php 
    ...
    $searchModel = new FinanceSearch();
    $searchModel->search(\Yii::$app->request->queryParams);
    
    $horizontalModels = Month::find()->all();
    $verticalModels = Type::find()->all();
    
    $treeDataProvider = new \yegorus\treegrid\TreeDataProvider([
        'verticalModels' => $verticalModels,
        'horizontalModels' => $horizontalModels,
        'searchModel' => $searchModel,
        'value' => function ($model) {
             $query = Finance::find()
                 ->filterType($model->verticalModel);
             
             if (!empty($model->horizontalModel)) {
                 $query->filterMonth($model->horizontalModel);
             }
            
             if (!empty($model->searchModel->project)) {
                 $query->filterProject($model->searchModel->project);
             }
            
             if (!empty($model->searchModel->account)) {
                 $query->filterAccount($model->searchModel->account);
             }
            
             return $query->sum('sum');
        },
    ]);
    ...
 
 ?>
```

```php
<?= \yegorus\treegrid\TreeGridView::widget([
    'treeDataProvider' => $treeDataProvider,
    'contentOptions' => function ($model) {
        return ['data-val' => $model->value];
    },
    'content' => function ($model, $url) {
        return Html::a(\Yii::$app->formatter->asCurrency($model->value), $url, ['target' => '_blank']);
    },
    'url' => function ($model) {
        return [
            '/finance/',
            'FinanceSearch[type_id]' => ArrayHelper::getValue($model, 'verticalModel.id'),
            'FinanceSearch[project_id]' => ArrayHelper::getValue($model, 'searchModel.project.id'),
            'FinanceSearch[account_id]' => ArrayHelper::getValue($model, 'searchModel.account.id'),
            'FinanceSearch[month_id]' => ArrayHelper::getValue($model, 'horizontalModel.id'),
        ];
    },

]); ?>

```

Result
-----

![Tree Grid View](http://i.imgur.com/C6X40DV.png)