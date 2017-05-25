<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Tickets');
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('/layouts/index', [
    'dataProvider' => $dataProvider,
    'modelName'    => 'Ticket',
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
        ['class' => 'yii\grid\ActionColumn'],
    ],
    'options'      => [
        'class' => 'ticket-index js-ticket-index'
    ]
]);

