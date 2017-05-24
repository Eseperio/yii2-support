<?php
/**
 * ViewAction
 * @version     1.0
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\actions;

/**
 * Class ViewAction
 */
class ViewAction extends BaseAction
{
    /**
     * @param int $id
     *
     * @return mixed
     */
    public function run($id)
    {
        return $this->controller->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
}
