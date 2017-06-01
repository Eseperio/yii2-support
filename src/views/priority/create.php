<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\Priority */

$this->title                   = Yii::t('priority', "Create Priority");
$this->params['breadcrumbs'][] = ['label' => Yii::t('priority', 'Priorities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->beginContent('@yiisupport/views/layouts/create.php', [
    'options' => [
        'class' => 'priority-create js-priority-create'
    ]
]);
echo $this->render('_form', [
    'model'   => $model,
]);
$this->endContent();