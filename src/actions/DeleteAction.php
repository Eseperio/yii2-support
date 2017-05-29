<?php
/**
 * DeleteAction
 * @version     1.0
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\actions;

/**
 * Class DeleteAction
 */
class DeleteAction extends BaseAction
{
    /**
     * @param int $id
     *
     * @return mixed
     */
    public function run($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect([$this->controller->getUniqueId()]);
    }
}
