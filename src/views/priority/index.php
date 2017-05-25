<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Priorities');
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('/layouts/index', [
    'dataProvider' => $dataProvider,
    'modelName'    => 'Priority',
    'columns'      => [
        'id',
        'name',
        'color',
        ['class' => 'yii\grid\ActionColumn'],
    ],
    'options'      => [
        'class' => 'priority-index js-priority-index'
    ]
]);
