<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \hexaua\yiisupport\models\Category */

$this->title                   = Yii::t('support', 'Category: {category}', ['category' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('support', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="category-view">

    <?php echo $this->render('@yiisupport/views/layouts/view.php', [
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
