<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/**
 * @var yii\web\View                $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var string                      $modelName
 * @var array                       $columns
 */

echo Html::beginTag('div', $options)

    . Html::tag('h1', Html::encode($this->title))
    . Html::beginTag('p')
    . Html::a(
        Yii::t('app', "Create {$modelName}"),
        ['create'],
        ['class' => 'btn btn-success']
    )
    . Html::endTag('p');


Pjax::begin();
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns'      => $columns,
]);
Pjax::end();

echo Html::endTag('div');
