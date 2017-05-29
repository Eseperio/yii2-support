<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \hexa\yiisupport\models\Ticket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'status_id')->dropdownList(
        \hexa\yiisupport\models\TicketStatus::find()->select(['name', 'id'])
            ->indexBy('id')
            ->column(),
        ['prompt' => Yii::t('app', 'Select Status')]
    ); ?>

    <?php echo $form->field($model, 'priority_id')->dropdownList(
        \hexa\yiisupport\models\TicketPriority::find()->select(['name', 'id'])
            ->indexBy('id')
            ->column(),
        ['prompt' => Yii::t('app', 'Select Priority')]
    ); ?>
    <?php echo $form->field($model, 'category_id')->dropdownList(
        \hexa\yiisupport\models\TicketCategory::find()->select(['name', 'id'])
            ->indexBy('id')
            ->column(),
        ['prompt' => Yii::t('app', 'Select Category')]
    ); ?>

    <div class="form-group">
        <?php echo Html::submitButton(
            Yii::t('app', 'Save'), [
            'class' => 'btn btn-primary',
        ]); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
