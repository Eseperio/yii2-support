<?php

/* @var $this yii\web\View */
/* @var $model \hexaua\yiisupport\models\Status */

$this->title                   = Yii::t('support', 'Update Status: {status}', ['status' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('support', 'Status'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('support', 'Update');

$this->beginContent('@yiisupport/views/layouts/update.php', [
    'options' => [
        'class' => 'status-update js-status-update'
    ]
]);

echo $this->render('_form', [
    'model' => $model,
]);

$this->endContent();
