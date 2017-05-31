<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\Status */

$this->title                   = Yii::t('status', 'Create Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('status', 'Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('/layouts/create', [
    'model'   => $model,
    'options' => [
        'class' => 'status-create js-status-create'
    ]
]);
