<?php

use hexa\yiisupport\helpers\Html;

/**
 * @var $this  yii\web\View
 * @var $model \hexa\yiisupport\models\Priority
 */

echo Html::beginTag('div', $options); ?>

<?php echo Html::title($this->title, 'h1'); ?>

<?php echo $this->context->renderPartial('_form', [
    'model' => $model,
]);

echo Html::endTag('div');
