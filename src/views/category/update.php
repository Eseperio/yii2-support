<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\TicketCategory */

$this->title                   = Yii::t('app', 'Update Category: {category}', ['category' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

echo $this->render('@yiisupport/views/layouts/update', [
    'model'   => $model,
    'options' => [
        'class' => 'category-update js-category-update'
    ]
]);
