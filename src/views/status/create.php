<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\TicketStatus */

$this->title                   = Yii::t('app', 'Create Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('/layouts/create', [
    'model'   => $model,
    'options' => [
        'class' => 'status-create js-status-create'
    ]
]);
