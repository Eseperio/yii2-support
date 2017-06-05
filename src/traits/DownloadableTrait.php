<?php
/**
 * UploadedTrait
 * @version     1.0
 * @license     http://mit-license.org/
 * @coder       Yevhenii Pylypenko <i.pylypenko@hexa.com.ua>
 * @coder       Alexander Oganov   <a.ohanov@hexa.com.ua>
 * @copyright   Copyright (C) Hexa,  All rights reserved.
 */

namespace hexa\yiisupport\traits;

use yii\helpers\FileHelper;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\web\UploadedFile;

/**
 * Trait DownloadableTrait
 *
 * @property UploadedFile|string $file
 */
trait DownloadableTrait
{
    /**
     * Save image to destination dir.
     * Check download status you can by access property.
     * @return $this
     */
    public function download()
    {
        $basePath = FileHelper::normalizePath($this->getUploadPath());
        if ($this->file instanceof UploadedFile && file_exists($basePath)) {

            $name = $this->generateName($this->file->baseName);
            $path = $basePath . '/' . $name;

            $this->file = $this->file->saveAs($path) ? $name : false;
        }

        return $this;
    }

    /**
     * Remove downloaded before image.
     */
    public function remove()
    {
        if (file_exists($this->file)) {
            return @unlink($this->file);
        }

        return false;
    }

    /**
     * @return string
     */
    public function basename()
    {
        return StringHelper::basename($this->file);
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected function generateName($name)
    {
        $name = strtolower(trim($name));
        $name = time() . '_' . Inflector::slug($name) . '.' . $this->file->extension;

        return $name;
    }

    /**
     * @return string
     */
    public function getUploadPath()
    {
        return \Yii::$app->controller->module->getSaveDir();
    }
}
