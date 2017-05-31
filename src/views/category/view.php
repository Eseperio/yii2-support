<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\Category */

$this->title                   = Yii::t('category', 'Category: {category}', ['category' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('category', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="category-view">

    <?php echo $this->render('/layouts/view', [
        'model'   => $model,
        'context' => 'category'
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
