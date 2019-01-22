<?php
namespace common\components\filestorage\lib;

/**
 * Interface IFileStorage
 * @package common\components\filestorage\lib
 */
interface IFileStorage
{
    public function saveFile($pathToFile, $dir = null);
    public function saveFileAndRemove($pathToFile, $dir = null);
    public function uploadFromModel($model, $attribute, $dir = null);
    public function multipleUploadFromModel($model, $attribute, $dir = null);
    public function upload($fileInputName, $dir = null);
    public function getFileOriginalName($id);
    public function getFileOriginalNameByPath($path);
    public function getFileUrl($id);
    public function getFileUrlByPath($path);
    public function getFilePath($id);
    public function getFullFilePathByPath($path);
    public function removeFile($id);
    public function removeFileByPath($path);
    public function getStoragePath($dir = null);
    public function getStorageUrl();
}