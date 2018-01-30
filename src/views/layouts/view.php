<?php

/* @var $this yii\web\View */

use hexaua\yiisupport\helpers\Html;

echo Html::title($this->title, 'h1');

echo Html::tag('p');

echo $this->render('_buttons', [
    'model' => $model
]);

echo Html::endTag('p');

