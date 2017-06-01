<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\Priority */

$this->title                   = Yii::t('priority', 'Update Priority: {priority}', ['priority' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('priority', 'Priorities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('priority', 'Update');

$this->beginContent('@yiisupport/views/layouts/update.php', [
    'options' => [
        'class' => 'priority-update js-priority-update'
    ]
]);

echo $this->render('_form', [
    'model' => $model,
]);

$this->endContent();
