<?php

use hexa\yiisupport\helpers\Html;
use hexa\yiisupport\models\Comment;
use yii\web\View;

/**
 * @var $this               View
 * @var $comment            Comment
 * @var $comments           array
 * @var $authorNameTemplate string
 * @var $maxLevel           null|integer comments max level
 **/

if (!empty($comments)) : ?>
    <ul class="comment-section">
        <?php foreach ($comments as $comment) : ?>
            <li class="comment <?php echo $comment->isByAuthor() ? 'author' : 'admin'; ?>-comment <?php echo $comment->file ? 'attachment' : null; ?>"
                id="comment-<?php echo $comment->id; ?>">
                <div class="info">
                    <a href="#comment-<?php echo $comment->id; ?>">
                        <?php echo $comment->resolveAuthorSignature($authorNameTemplate); ?>
                    </a>
                    <span><?php echo Yii::$app->formatter->asRelativeTime($comment->created_at); ?></span>
                </div>

                <a class="avatar" href="#comment-<?php echo $comment->id; ?>">&nbsp;</a>
                <p>
                    <?php echo nl2br(Html::encode($comment->content)); ?>

                    <?php if ($comment->file) : ?>
                        <span class="center-block text-right">

                            <a href="<?php echo Yii::$app->controller->module->getUploadUrl($comment->file); ?>"
                               class="comment-attachment js-comment-attachment"
                               data-pjax="0">
                                <i class="fa fa-paperclip" aria-hidden="true"></i>
                                <?php echo Yii::t('comment', 'Attachment'); ?>
                            </a>
                        </span>
                    <?php endif; ?>
                </p>

            </li>
        <?php endforeach; ?>
    </ul>
<?php endif;
