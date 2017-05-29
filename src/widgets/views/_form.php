<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this        \yii\web\View
 * @var $model       \hexa\yiisupport\models\TicketComment
 * @var $hash        string
 * @var $formOptions array of html attributes
 */

?>

<div class="comment-form-container">
    <?php $form = ActiveForm::begin($formOptions); ?>

    <?php echo $form->field($model, 'content', ['template' => '{input}{error}'])->textarea([
        'placeholder' => Yii::t('app', 'Add a comment...'),
        'rows'        => 4,
        'data'        => ['comment' => 'content']
    ]); ?>

    <div class="comment-box-partial">
        <div class="button-container show">
            <?php echo Html::submitButton(
                Yii::t('app', 'Comment'),
                ['class' => 'btn btn-primary comment-submit']
            ); ?>
        </div>
    </div>
    <?php $form->end(); ?>
</div>
