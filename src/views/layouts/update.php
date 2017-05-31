<?php

use yii\helpers\Html;

/**
 * @var       $this  yii\web\View
 * @var       $model \hexa\yiisupport\models\Priority
 * @var array $options
 */

echo Html::beginTag('div', $options)

    . Html::tag('h1', Html::encode($this->title))
    . $this->context->renderPartial('_form', [
        'model' => $model,
    ])
    . Html::endTag('div');
