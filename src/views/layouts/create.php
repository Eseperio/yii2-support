<?php

use hexaua\yiisupport\helpers\Html;

/**
 * @var $this  yii\web\View
 * @var $model \hexaua\yiisupport\models\Priority
 */

echo Html::beginTag('div', $options); ?>

<?php echo Html::title($this->title, 'h1'); ?>

<?php echo $content;

echo Html::endTag('div');
