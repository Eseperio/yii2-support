<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\TicketPriority */

$this->title                   = Yii::t('app', 'Priority: {priority}', ['priority' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Priorities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="priority-view">

    <?php echo $this->render('@yiisupport/views/layouts/view', [
        'model' => $model
    ]); ?>

    <?php echo DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'name',
            'color',
        ],
    ]); ?>
</div>
