<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\Ticket */

$this->title                   = Yii::t('app', 'Create Ticket');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('@yiisupport/views/layouts/create', [
    'model'   => $model,
    'options' => [
        'class' => 'status-create js-status-create'
    ]
]);
