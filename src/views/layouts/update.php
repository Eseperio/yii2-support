<?php


/**
 * @var       $this  yii\web\View
 * @var       $model \hexaua\yiisupport\models\Priority
 * @var array $options
 */

use hexaua\yiisupport\helpers\Html;

echo Html::beginTag('div', $options)

    . Html::title($this->title, 'h1')
    . $content
    . Html::endTag('div');
