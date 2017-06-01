<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\Status */

$this->title                   = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('status', 'Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="status-view">

    <?php echo $this->render('@yiisupport/views/layouts/view.php', [
        'model'  => $model,
        'context' => 'status'
    ]); ?>

    <?php echo DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'name',
            'color'
        ]
    ]); ?>
</div>
