<?php

use hexa\yiisupport\db\ActiveRecord;
use hexa\yiisupport\models\TicketComment;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var $this                                   View
 * @var $comments                               array
 * @var $model                                  TicketComment|ActiveRecord
 * @var $maxLevel                               null|integer comments max level
 * @var $hash                                   string
 * @var $authorNameTemplate                     string
 * @var $containerId                            string
 * @var $formOptions                            string Array of html attributes
 * @var $showDeletedComments                    boolean show deleted comments
 **/

$showDeletedComments = true;

Pjax::begin([
    'enablePushState' => false,
    'timeout'         => 20000,
    'id'              => $containerId
]); ?>
    <div class="comments">
        <div class="title-block clearfix clear">

            <h3 class="h3-body-title">
                <?php echo Yii::t('app', 'Comments') . '(' . $model->getCommentsCount() . ')'; ?>
            </h3>

            <div class="title-separator"></div>
        </div>
        <?php echo $this->render('_list', [
            'comments'           => $comments,
            'maxLevel'           => 3,
            'authorNameTemplate' => $authorNameTemplate
        ]); ?>
        <?php echo $this->render('_form', [
            'model'       => $model,
            'hash'        => $hash,
            'formOptions' => $formOptions
        ]); ?>

    </div>
<?php Pjax::end();