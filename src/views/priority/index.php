<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Priorities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a(
            'Create Priority', ['create'],
            ['class' => 'btn btn-success']
        ) ?>
    </p>
    <?php Pjax::begin(); ?>    <?php echo GridView::widget(
        [
        'dataProvider' => $dataProvider,
        'columns'      => [
            'id',
            'name',
            'color',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        ]
    ); ?>
    <?php Pjax::end(); ?></div>
