<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\Category */

$this->title                   = Yii::t('category', 'Update Category: {category}', ['category' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('category', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('category', 'Update');

$this->beginContent('@yiisupport/views/layouts/update.php', [
    'options' => [
        'class' => 'category-update js-category-update'
    ]
]);

echo $this->render('_form', [
    'model' => $model,
]);

$this->endContent();
