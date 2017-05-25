<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Statuses');
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('@yiisupport/views/layouts/index', [
    'dataProvider' => $dataProvider,
    'modelName'    => 'Status',
    'columns'      => [
        'id',
        'name',
        'color',
        ['class' => 'yii\grid\ActionColumn'],
    ],
    'options'      => [
        'class' => 'status-index js-status-index'
    ]
]);