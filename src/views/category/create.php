<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\Category */

$this->title                   = Yii::t('category', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('category', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->beginContent('@yiisupport/views/layouts/create.php', [
    'options' => [
        'class' => 'category-create js-category-create'
    ]
]);
echo $this->render('_form', [
    'model'   => $model,
]);
$this->endContent();