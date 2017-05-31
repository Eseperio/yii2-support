<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\Status */

$this->title                   = Yii::t('status', 'Update Status: {status}', ['status' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('status', 'Status'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('status', 'Update');

echo $this->render('/layouts/update', [
    'model'   => $model,
    'options' => [
        'class' => 'status-update js-status-update'
    ]
]);
