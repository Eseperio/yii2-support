<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\TicketCategory */

$this->title                   = Yii::t('app', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('/layouts/create', [
    'model'   => $model,
    'options' => [
        'class' => 'category-create js-category-create'
    ]
]);
