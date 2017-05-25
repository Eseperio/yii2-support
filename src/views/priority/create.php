<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\TicketPriority */

$this->title                   = Yii::t('app', "Create Priority");
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Priorities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('@yiisupport/views/layouts/create', [
    'model'   => $model,
    'options' => [
        'class' => 'priority-create js-priority-create'
    ]
]);
