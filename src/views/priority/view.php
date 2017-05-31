<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\Priority */

$this->title                   = Yii::t('priority', 'Priority: {priority}', ['priority' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('priority', 'Priorities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="priority-view">

    <?php echo $this->render('/layouts/view', [
        'model'  => $model,
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
