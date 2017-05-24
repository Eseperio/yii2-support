<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Tickets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a(
            'Create Ticket', ['create'],
            ['class' => 'btn btn-success']
        ) ?>
    </p>
    <?php Pjax::begin(); ?>    <?php echo GridView::widget(
        [
        'dataProvider' => $dataProvider,
        'columns'      => [
            'id',
            [
                'attribute' => 'client_id',
                'value'     => 'client.email',
            ],
            //            [
            //                'attribute' => 'site_id',
            //                'value'     => 'site.title',
            //            ],
            'subject',
            'content:ntext',
            [
                'attribute' => 'status_id',
                'value'     => 'status.name',
            ],
            [
                'attribute' => 'priority_id',
                'value'     => 'priority.name',
            ],
            [
                'attribute' => 'category_id',
                'value'     => 'category.name',
            ],
            'completed_at',
            'created_at',
            'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        ]
    ); ?>
    <?php Pjax::end(); ?></div>
