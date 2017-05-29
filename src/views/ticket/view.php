<?php

use hexa\yiisupport\models\Ticket;
use hexa\yiisupport\models\TicketComment;
use hexa\yiisupport\widgets\Comment;
use yii\widgets\DetailView;

/**
 * @var $this                  yii\web\View
 * @var $model                 Ticket
 * @var $comments              TicketComment[]
 * @var $secret                string
 * @var $authorNameTemplate    string
 **/

$this->title                   = Yii::t('app', 'Ticket: {subject}', ['subject' => $model->subject]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="ticket-view">

    <?php echo $this->render('/layouts/view', [
        'model' => $model
    ]); ?>

    <?php echo DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'subject',
            'content:ntext',
            'status.name',
            'priority.name',
            'category.name',
            'completed_at',
            'created_at',
            'updated_at',
        ]
    ]); ?>

    <?php echo Comment::widget([
        'ticketId'           => $model->id,
        'hash'               => $model->getHash($secret),
        'comments'           => $comments,
        'authorNameTemplate' => $authorNameTemplate,
        'formOptions'        => [
            'action' => [
                'comment/create', 'entity' => $model->getHash($secret)
            ]
        ]
    ]); ?>

</div>
