<?php

use hexaua\yiisupport\helpers\Html;

/**
 * @var yii\web\View                $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var string                      $content
 * @var array                       $columns
 */

echo Html::beginTag('div', $options)

    . Html::title(Html::encode($this->title), 'h1')
    . Html::beginTag('p')
    . Html::a(
        Yii::t('support', "Create"),
        ['create'],
        ['class' => 'btn btn-success']
    )
    . Html::endTag('p');

echo $content;

echo Html::endTag('div');
