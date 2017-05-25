<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('@yiisupport/views/layouts/index', [
    'dataProvider' => $dataProvider,
    'modelName'    => 'Category',
    'columns'      => [
        'id',
        'name',
        'color',
        ['class' => 'yii\grid\ActionColumn'],
    ],
    'options'      => [
        'class' => 'category-index js-category-index'
    ]
]);
