<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\TicketStatus */

$this->title                   = Yii::t('app', 'Update Status: {status}', ['status' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Status'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

echo $this->render('@yiisupport/views/layouts/update', [
    'model'   => $model,
    'options' => [
        'class' => 'status-update js-status-update'
    ]
]);
