<?php

use hexa\yiisupport\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View                $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var string                      $modelName
 * @var array                       $columns
 */

echo Html::beginTag('div', $options)

    . Html::title(Html::encode($this->title), 'h1')
    . Html::beginTag('p')
    . Html::a(
        Yii::t('default', "Create {$modelName}"),
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
