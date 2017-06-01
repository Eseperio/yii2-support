<?php
/**
 * Button group view
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

use hexa\yiisupport\helpers\Html;

echo Html::beginTag('div', ['class' => 'btn-group margin-bottom-20']);

echo $this->render('_update-button', [
    'model' => $model
]);

echo $this->render('_delete-button', [
    'model' => $model
]);

echo Html::endTag('div');
