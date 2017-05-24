<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/**
 * @var $this   yii\web\View
 * @var $all    integer
 * @var $opened integer
 * @var $closed integer
 **/

$this->title                   = Yii::t('app', 'Dashboard');
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="ticket-index">

    <h1>
        <?php echo Html::encode($this->title); ?>
    </h1>

    <?php Pjax::begin(); ?>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3" style="font-size: 5em;">
                            <i class="glyphicon glyphicon-th"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <h1><?php echo $all ?></h1>
                            <div>Total tickets</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3" style="font-size: 5em;">
                            <i class="glyphicon glyphicon-wrench"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <h1><?php echo $opened ?></h1>
                            <div>Open tickets</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3" style="font-size: 5em;">
                            <i class="glyphicon glyphicon-thumbs-up"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <h1><?php echo $closed ?></h1>
                            <span>Closed tickets</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
