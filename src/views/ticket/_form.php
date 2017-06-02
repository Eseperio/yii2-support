<?php

use hexa\yiisupport\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this       yii\web\View
 * @var $model      \hexa\yiisupport\models\Ticket
 * @var $form       yii\widgets\ActiveForm
 * @var $categories array
 * @var $priorities array
 **/
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin();

    echo $form->field($model, 'subject')->textInput(['maxlength' => true]);
    echo $form->field($model, 'content')->textarea(['rows' => 6]);
    echo $form->field($model, 'priority_id')->dropdownList($priorities, [
        'prompt' => Yii::t('ticket', 'Select Priority')
    ]);
    echo $form->field($model, 'category_id')->dropdownList($categories, [
        'prompt' => Yii::t('ticket', 'Select Category')
    ]);
    echo $form->field($model, 'file')->fileInput(); ?>

    <div class="form-group">
        <?php echo Html::submitButton(
            Yii::t('main', 'Save'), [
            'class' => 'btn btn-primary',
        ]); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
