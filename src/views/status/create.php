<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\Status */

$this->title                   = Yii::t('status', 'Create Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('status', 'Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->beginContent('@yiisupport/views/layouts/create.php', [
    'options' => [
        'class' => 'status-create js-status-creat'
    ]
]);
echo $this->context->renderPartial('_form', [
    'model'   => $model,
]);
$this->endContent();

