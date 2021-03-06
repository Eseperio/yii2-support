<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \hexaua\yiisupport\models\Priority */

$this->title                   = Yii::t('support', 'Priority: {priority}', ['priority' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('support', 'Priorities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="priority-view">

    <?php echo $this->render('@yiisupport/views/layouts/view', [
        'model'   => $model,
        'context' => 'priority'
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
