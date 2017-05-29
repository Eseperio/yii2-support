<?php

use hexa\yiisupport\models\TicketComment;
use yii\web\View;

/**
 * @var $this               View
 * @var $comment            TicketComment
 * @var $comments           array
 * @var $authorNameTemplate string
 * @var $maxLevel           null|integer comments max level
 **/

if (!empty($comments)) : ?>
    <?php foreach ($comments as $comment) : ?>

        <div class="panel panel-default" id="comment-<?php echo $comment->id ?>">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?php echo $comment->resolveAuthorSignature($authorNameTemplate); ?>
                    <span class="pull-right">
                        <?php echo Yii::$app->formatter->asDatetime($comment->created_at); ?>
                    </span>
                </h3>
            </div>

            <div class="panel-body">
                <div class="content">
                    <?php echo nl2br($comment->content) ?>
                </div>
            </div>

        </div>
    <?php endforeach;
endif;
