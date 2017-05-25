<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\TicketPriority */

$this->title                   = Yii::t('app', 'Update Priority: {priority}', ['priority' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Priorities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

echo $this->render('/layouts/update', [
    'model'   => $model,
    'options' => [
        'class' => 'priority-update js-priority-update'
    ]
]);
