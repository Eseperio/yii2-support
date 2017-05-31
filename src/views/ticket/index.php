<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('ticket', 'Tickets');
$this->params['breadcrumbs'][] = $this->title;

$this->beginContent('@yiisupport/views/layouts/index.php', [
    'options' => [
        'class' => 'ticket-index js-ticket-index'
    ]
]);

Pjax::begin();
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns'      => [
        'id',
        'subject',
        'content:ntext',
        [
            'attribute' => 'status_id',
            'value'     => 'status.name',
        ],
        [
            'attribute' => 'priority_id',
            'value'     => 'priority.name',
        ],
        [
            'attribute' => 'category_id',
            'value'     => 'category.name',
        ],
        'completed_at',
        'created_at',
        'updated_at',
        [
            'class'          => 'yii\grid\ActionColumn',
            'visibleButtons' => [
                'update' => Yii::$app->user->can($this->context->module->adminRole),
                'delete' => Yii::$app->user->can($this->context->module->adminRole),
            ]
        ],
    ],
]);
Pjax::end();

$this->endContent();
