<?php

/* @var $this yii\web\View */
/* @var $model \hexaua\yiisupport\models\Priority */

$this->title                   = Yii::t('support', 'Update Priority: {priority}', ['priority' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('support', 'Priorities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('support', 'Update');

$this->beginContent('@yiisupport/views/layouts/update.php', [
    'options' => [
        'class' => 'priority-update js-priority-update'
    ]
]);

echo $this->render('_form', [
    'model' => $model,
]);

$this->endContent();
