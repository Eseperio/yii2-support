<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\Ticket */

$this->title                   = Yii::t('ticket', 'Create Ticket');
$this->params['breadcrumbs'][] = ['label' => Yii::t('ticket', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->beginContent('@yiisupport/views/layouts/create.php', [
    'options' => [
        'class' => 'ticket-create js-ticket-create'
    ]
]);

echo $this->render('_form', [
    'model'      => $model,
    'categories' => $categories,
    'priorities' => $priorities,
]);

$this->endContent();
