<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\TicketCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'color')->input('color') ?>

    <div class="form-group">
        <?php echo Html::submitButton(
            Yii::t('app', $model->isNewRecord ? 'Create' : 'Update'),
            [
                'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            ]
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>