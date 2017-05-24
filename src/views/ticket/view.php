<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \modules\support\models\Ticket */
/* @var $commentModel \modules\support\models\TicketComment */

$this->title                   = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-view">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a(
            'Update', ['update', 'id' => $model->id],
            ['class' => 'btn btn-primary']
        ) ?>
        <?php echo Html::a(
            'Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method'  => 'post',
            ],
            ]
        ) ?>
    </p>

    <?php echo DetailView::widget(
        [
        'model'      => $model,
        'attributes' => [
            'id',
            'client.email:email',
        //            'site_id',
            'subject',
            'content:ntext',
            'status.name',
            'priority.name',
            'category.name',
            'completed_at',
            'created_at',
            'updated_at',
        ],
        ]
    ) ?>


    <?php echo \modules\support\widgets\Comment::widget(
        [
        'model' => $model
        ]
    ) ?>
</div>
