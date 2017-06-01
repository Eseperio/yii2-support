<?php


/**
 * @var       $this  yii\web\View
 * @var       $model \hexa\yiisupport\models\Priority
 * @var array $options
 */

use hexa\yiisupport\helpers\Html;

echo Html::beginTag('div', $options)

    . Html::title($this->title, 'h1')
    . $content
    . Html::endTag('div');
