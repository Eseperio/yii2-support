<?php

use hexa\yiisupport\models\Ticket;
use hexa\yiisupport\widgets\Comments;
use yii\widgets\DetailView;

/**
 * @var $this                  yii\web\View
 * @var $model                 Ticket
 * @var $comments              Comments[]
 * @var $hash                  string
 * @var $authorNameTemplate    string
 **/


$this->title = Yii::t('ticket', 'Ticket: {subject}', ['subject' => $model->subject]);

$this->params['breadcrumbs'][] = ['label' => Yii::t('ticket', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="ticket-view">

    <?php echo $this->render('@yiisupport/views/ticket/_buttons', [
        'model' => $model
    ]); ?>
    <?php echo DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            [
                'attribute'      => 'subject',
                'contentOptions' => ['class' => 'pre-wrap'],
            ],
            [
                'attribute'      => 'content',
                'contentOptions' => ['class' => 'pre-wrap'],
            ],
            'status.name',
            'priority.name',
            'category.name',
            [
                'attribute' => 'file',
                'format'    => 'html',
                'value'     => function ($model) {
                    return \yii\helpers\Html::a($model->basename(), $model->file);
                }
            ],
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
