<?php

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\Ticket */

use hexa\yiisupport\helpers\Html;

$this->title                   = Yii::t('app', 'Create Ticket');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo Html::beginTag('div', [
    'class' => 'status-create js-status-create'
]); ?>

<?php echo Html::title($this->title, 'h1'); ?>

<?php echo $this->context->renderPartial('_form', [
    'model'      => $model,
    'categories' => $categories,
    'priorities' => $priorities,
]);

echo Html::endTag('div');
