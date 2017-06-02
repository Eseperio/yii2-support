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
        $path     = \Yii::getAlias($this->getUploadPath());
        $basePath = \Yii::getAlias('@webroot');

        if ($this->file instanceof UploadedFile && FileHelper::createDirectory($path)) {

            $path .= '/' . time() . "_{$this->file->baseName}.{$this->file->extension}";
            $isOk = $this->file->saveAs($path) ? $path : false;

            $this->file = ($isOk ? str_replace($basePath, '', $path) : false);
        };

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
     * Gets the basename from the path
     * @return string
     */
    public function basename()
    {
        return StringHelper::basename($this->file);
    }

    /**
     * @return string
     */
    abstract public function getUploadPath();
}
