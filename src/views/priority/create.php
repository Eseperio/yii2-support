<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\Priority */

$this->title                   = Yii::t('priority', "Create Priority");
$this->params['breadcrumbs'][] = ['label' => Yii::t('priority', 'Priorities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('/layouts/create', [
    'model'   => $model,
    'options' => [
        'class' => 'priority-create js-priority-create'
    ]
]);
