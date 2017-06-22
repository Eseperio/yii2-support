<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $isUpdate     bool
 * @var $isDelete     bool
 */

$this->title                   = Yii::t('support', 'Tickets');
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
        [
            'attribute'      => 'subject',
            'contentOptions' => [
                'class' => 'pre-wrap'
            ]
        ],
        [
            'attribute'      => 'content',
            'contentOptions' => [
                'class' => 'pre-wrap'
            ]
        ],
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
        [
            'class'          => 'yii\grid\ActionColumn',
            'visibleButtons' => [
                'update' => Yii::$app->user->can($this->context->module->adminRole) && $isUpdate,
                'delete' => Yii::$app->user->can($this->context->module->adminRole) && $isDelete,
            ]
        ],
    ],
]);
Pjax::end();

$this->endContent();
