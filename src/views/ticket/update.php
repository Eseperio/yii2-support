<?php

/**
 * @var $this       yii\web\View
 * @var $model      \hexa\yiisupport\models\Ticket
 * @var $categories array
 * @var $priorities array
 */

$this->title                   = Yii::t('ticket', 'Update Ticket: {ticket}', ['ticket' => $model->id]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('ticket', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('ticket', 'Update');

$this->beginContent('@yiisupport/views/layouts/update.php', [
    'options' => [
        'class' => 'ticket-update js-ticket-update'
    ]
]);

echo $this->render('_form', [
    'model'      => $model,
    'categories' => $categories,
    'priorities' => $priorities
]);

$this->endContent();