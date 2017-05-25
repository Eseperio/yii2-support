<?php

use yii\helpers\Html;

/**
 * @var       $this  yii\web\View
 * @var       $model \hexa\yiisupport\models\TicketPriority
 * @var array $options
 */

echo Html::beginTag('div', $options)

    . Html::tag('h1', Html::encode($this->title))
    . $this->render('_form', [
        'model' => $model,
    ])
    . Html::endTag('div');
