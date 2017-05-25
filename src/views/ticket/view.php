<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\Ticket */
/* @var $commentModel \hexa\yiisupport\models\TicketComment */

$this->title                   = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title; ?>
<div class="ticket-view">

    <?php echo $this->render('@yiisupport/views/layouts/view', [
        'model' => $model
    ]); ?>

    <?php echo DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'client.email:email',
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

    <?php echo \hexa\yiisupport\widgets\Comment::widget([
        'model'  => $model,
        'secret' => Yii::$app->controller->module->param('secret')
    ]); ?>

</div>
