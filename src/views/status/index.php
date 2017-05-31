<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('status', 'Statuses');
$this->params['breadcrumbs'][] = $this->title;

$this->beginContent('@yiisupport/views/layouts/index.php', [
    'options' => [
        'class' => 'status-index js-status-index'
    ]
]);

Pjax::begin();
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns'      => [
        'id',
        'name',
        'color',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]);
Pjax::end();
$this->endContent();
