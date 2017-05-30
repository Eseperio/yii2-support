<?php

use hexa\yiisupport\models\Ticket;
use hexa\yiisupport\models\TicketComment;
use hexa\yiisupport\widgets\Comment;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;

/**
 * @var $this                  yii\web\View
 * @var $model                 Ticket
 * @var $comments              TicketComment[]
 * @var $secret                string
 * @var $authorNameTemplate    string
 **/

$category                      = ArrayHelper::getValue($this->context->module, 'languageCategory');
$this->title                   = Yii::t($category, 'Ticket: {subject}', ['subject' => $model->subject]);
$this->params['breadcrumbs'][] = ['label' => Yii::t($category, 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="ticket-view">
    <p>
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
    </p>
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
