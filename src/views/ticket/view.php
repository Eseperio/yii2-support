<?php

use hexa\yiisupport\models\Ticket;
use hexa\yiisupport\widgets\Comments;
use yii\widgets\DetailView;

/**
 * @var $this                  yii\web\View
 * @var $model                 Ticket
 * @var $comments              Comments[]
 * @var $secret                string
 * @var $authorNameTemplate    string
 **/

$this->title                   = Yii::t('ticket', 'Ticket: {subject}', ['subject' => $model->subject]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('ticket', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="ticket-view">
    <div class="btn-group">
        <?php if (Yii::$app->user->can('updateTicket')):
            echo $this->render('/layouts/_update-button', [
                'model' => $model
            ]);
        endif; ?>

        <?php if (Yii::$app->user->can('deleteTicket')):
            echo $this->render('/layouts/_delete-button', [
                'model' => $model
            ]);
        endif; ?>

        <?php echo $this->render('_resolve-button', [
            'model' => $model
        ]); ?>
    </div>
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

    <?php echo Comments::widget([
        'ticketId'           => $model->id,
        'hash'               => $hash,
        'comments'           => $comments,
        'authorNameTemplate' => $authorNameTemplate,
        'formOptions'        => [
            'action' => [
                'comment/create', 'entity' => $hash
            ]
        ]
    ]); ?>

</div>
