<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\Ticket */

$this->title                   = Yii::t('app', 'Update Ticket: {ticket}', ['ticket' => $model->id]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

echo $this->render('@yiisupport/views/layouts/update', [
    'model'   => $model,
    'options' => [
        'class' => 'ticket-update js-ticket-update'
    ]
]);
