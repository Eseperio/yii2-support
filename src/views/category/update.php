<?php

/* @var $this yii\web\View */
/* @var $model \hexaua\yiisupport\models\Category */

$this->title                   = Yii::t('support', 'Update Category: {category}', ['category' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('support', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('support', 'Update');

$this->beginContent('@yiisupport/views/layouts/update.php', [
    'options' => [
        'class' => 'category-update js-category-update'
    ]
]);

echo $this->render('_form', [
    'model' => $model,
]);

$this->endContent();
