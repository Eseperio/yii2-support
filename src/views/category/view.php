<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\TicketCategory */

$this->title                   = Yii::t('app', 'Category: {category}', ['category' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="category-view">

    <?php echo $this->render('/layouts/view', [
        'model' => $model
    ]); ?>

    <?php echo DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'name',
            'color',
        ]
    ]); ?>
</div>
