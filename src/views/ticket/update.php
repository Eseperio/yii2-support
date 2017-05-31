<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\Ticket */

$this->title                   = Yii::t('ticket', 'Update Ticket: {ticket}', ['ticket' => $model->id]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('ticket', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('ticket', 'Update');

echo $this->render('/layouts/update', [
    'model'   => $model,
    'options' => [
        'class' => 'ticket-update js-ticket-update'
    ]
]);
