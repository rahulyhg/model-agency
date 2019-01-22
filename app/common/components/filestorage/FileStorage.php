<?php
namespace common\components\filestorage;

use common\components\filestorage\lib\IFileStorage;
use common\components\filestorage\models\File;
use yii\base\Exception;
use yii\helpers\Url;
use yii\web\UploadedFile;
use common\components\filestorage\exceptions\FileNotFoundException;

/**
 * Class FileStorage for file management
 * @package common\components\filestorage
 */
class FileStorage extends \yii\base\Component implements IFileStorage
{
    /**
     * @var string path to storage folder
     */
    public $storagePath;

    /**
     * @var string URL to storage folder
     */
    public $fileRoute;

    /**
     * @throws Exception
     */
    public function init()
    {
        parent::init();
        if( !$this->storagePath )
            throw new Exception('storagePath is not defined in FileStorage component');
        if( !$this->fileRoute )
            throw new Exception('fileRoute is not defined in FileStorage component');
    }

    /**
     * @param $pathToFile
     * @param null $dir
     * @return bool|int
     * @throws Exception
     * @throws FileNotFoundException
     */
    public function saveFile($pathToFile, $dir = null)
    {
        $dir = $this->_correctDir($dir);
        if( file_exists($pathToFile) ) {
            $pathInfo = pathinfo($pathToFile);
            $newFileName = $this->_generateUniqueFileName($pathInfo['filename'], $pathInfo['extension']);
            if( $dir !== null ) {
                $dirName = $this->storagePath . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR;
                if( ! is_dir($dirName) && !mkdir($dirName, 0777, true) ) {
                    throw new Exception('Can not create directory ' . $dirName);
                }
                $newPath = $dirName . $newFileName;
                $path = $dir . DIRECTORY_SEPARATOR . $newFileName;
            } else {
                $newPath = $this->storagePath . DIRECTORY_SEPARATOR . $newFileName;
                $path = $newFileName;
            }
            $copyCheck = copy($pathToFile, $newPath);
            $dbCheck = $this->_saveFileToDB($path, $pathInfo['basename']);
            if( $dbCheck === false ) {
                unlink($newPath);
                return false;
            }
            if($copyCheck === true && $dbCheck !== false) {
                return $dbCheck;
            }
        } else {
            throw new FileNotFoundException('Файл не найден');
        }
        return false;
    }

    /**
     * Save file to file storage and remove from old path
     * @param $pathToFile
     * @param null $dir
     * @return bool|int
     * @throws Exception
     * @throws \common\components\filestorage\exceptions\FileNotFoundException
     */
    public function saveFileAndRemove($pathToFile, $dir = null)
    {
        $dir = $this->_correctDir($dir);
        if( file_exists($pathToFile) ) {
            $pathInfo = pathinfo($pathToFile);
            $newFileName = $this->_generateUniqueFileName($pathInfo['filename'], $pathInfo['extension']);
            if( $dir !== null ) {
                $dirName = $this->storagePath . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR;
                if( ! is_dir($dirName) && !mkdir($dirName, 0777, true) ) {
                    throw new Exception('Can not create directory ' . $dirName);
                }
                $newPath = $dirName . $newFileName;
                $path = $dir . DIRECTORY_SEPARATOR . $newFileName;
            } else {
                $newPath = $this->storagePath . DIRECTORY_SEPARATOR . $newFileName;
                $path = $newFileName;
            }
            $renameCheck = rename($pathToFile, $newPath);
            $dbCheck = $this->_saveFileToDB($path, $pathInfo['basename']);
            if( $dbCheck === false ) {
                unlink($newPath);
                return false;
            }
            if($renameCheck === true && $dbCheck !== false) {
                return $dbCheck;
            }
        } else {
            throw new FileNotFoundException('Файл не найден');
        }
        return false;
    }

    /**
     * Upload file from model attribute
     * @param $model
     * @param $attribute
     * @param $dir
     * @return false|int false если загрузка не удалась, id записи о файле в базу данных, если загрузка успешна
     */
    public function uploadFromModel($model, $attribute, $dir = null)
    {
        $dir = $this->_correctDir($dir);
        $file = UploadedFile::getInstance($model, $attribute);
        return $this->uploadFile($file, $dir);
    }

    /**
     * Multiply upload files from model array attribute
     * @param $model
     * @param $attribute
     * @param $dir
     * @return false|int[] false если загрузка не удалась, массив id записей о файле в базе данных, если загрузка успешна
     */
    public function multipleUploadFromModel($model, $attribute, $dir = null)
    {
        $dir = $this->_correctDir($dir);
        if( $model->$attribute ) {
            $files = UploadedFile::getInstances($model, $attribute);
            if( $files ) {
                $check = true;
                $fileIds = [];
                foreach ($files as $file) {
                    $result = $this->uploadFile($file, $dir);
                    $fileIds[] = $result;
                    if( $check ) {
                        $check = $result ?: true;
                    }
                }
                return $fileIds;
            }
        }
        return false;
    }

    /**
     * Upload file by input name
     * @param $fileInputName
     * @param $dir
     * @return bool|int
     */
    public function upload($fileInputName, $dir = null)
    {
        $dir = $this->_correctDir($dir);
        // Получаем файл
        $file = UploadedFile::getInstanceByName($fileInputName);
        return $this->uploadFile($file, $dir);
    }

    /**
     * Upload file to file storage and save that data to DB
     * @param $uploadedFile UploadedFile
     * @param $dir string дирректория, в которую будет загружен файл
     * @return bool|int
     * @throws Exception
     */
    public function uploadFile($uploadedFile, $dir = null)
    {
        $dir = $this->_correctDir($dir);
        if( $uploadedFile ) {
            // Генерируем имя нового файла
            $newFileName = $this->_generateUniqueFileName($uploadedFile->baseName, $uploadedFile->getExtension());
            $path = ''; // path файла, который буду сохранять в базу данных
            // Получаем Path файла
            if( $dir ) {
                $dirName = $this->storagePath . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR;
                // Если дирректории не существует, создаю ее
                if( ! is_dir($dirName) && !mkdir($dirName, 0777, true) ) {
                    throw new Exception('Can not create directory ' . $dirName);
                }
                $filePath = $dirName . $newFileName;
                $path = $dir . DIRECTORY_SEPARATOR . $newFileName;
            } else {
                $filePath = $this->storagePath . DIRECTORY_SEPARATOR . $newFileName;
            }
            // Сохраняем файл на диск
            if( $uploadedFile->saveAs($filePath) ) {
                return $this->_saveFileToDB($path, $uploadedFile->name);
            }
        }
        return false;
    }

    /**
     * Get original file name by file id
     * @param $id
     * @return bool|string
     */
    public function getFileOriginalName($id)
    {
        $fileModel = File::findOne($id);
        if( $fileModel ) {
            return $fileModel->original_name;
        }
        return false;
    }

    /**
     * Get original file name by real file name in file storage (specify the file name format)
     * @param $path
     * @return string
     */
    public function getFileOriginalNameByPath($path)
    {
        $path = $this->_correctDir($path);
        $fileModel = File::findOne(['path' => $path]);
        if( $fileModel ) {
            return $fileModel->original_name;
        }
        return false;
    }

    /**
     * Get file URL by id
     * @param $id
     * @return string
     */
    public function getFileUrl($id)
    {
        $fileModel = File::findOne($id);
        if( $fileModel ) {
            return Url::to([$this->fileRoute, 'name' => $fileModel->path]);
        }
        return false;
    }

    /**
     * Get file URL by real name (or path) (specify the file name format)
     * @param $path
     * @return string
     */
    public function getFileUrlByPath($path)
    {
        $path = $this->_correctDir($path);
        $fileModel = File::findOne(['path' => $path]);
        if( $fileModel ) {
            return Url::to([$this->fileRoute, 'name' => $fileModel->path]);
        }
        return false;
    }

    /**
     * Get path to file by file id
     * @param $id
     * @return string
     */
    public function getFilePath($id)
    {
        $fileModel = File::findOne($id);
        if( $fileModel ) {
            return $this->storagePath . DIRECTORY_SEPARATOR . $fileModel->path;
        }
        return false;
    }

    /**
     * Get path to file by file name (or path) (specify the file name format)
     * @param $path
     * @return string
     */
    public function getFullFilePathByPath($path)
    {
        $path = $this->_correctDir($path);
        $fileModel = File::findOne(['path' => $path]);
        if( $fileModel ) {
            return $this->storagePath . DIRECTORY_SEPARATOR . $fileModel->path;
        }
        return false;
    }

    /**
     * Remove file from file storage and DB by file id
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function removeFile($id)
    {
        $fileModel = File::findOne($id);
        if( $fileModel && file_exists($this->getFilePath($id)) && unlink($this->storagePath . DIRECTORY_SEPARATOR . $fileModel->path) ) {
            if($fileModel->delete() !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Remove file from file storage and DB by file real name (specify the file name format)
     * @param $path
     * @return bool
     * @throws \Exception
     */
    public function removeFileByPath($path)
    {
        $path = $this->_correctDir($path);
        $fileModel = File::findOne(['path' => $path]);
        if( $fileModel && unlink($this->storagePath . DIRECTORY_SEPARATOR . $fileModel->path) ) {
            if($fileModel->delete() !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Return full filestorage path
     * @param null $dir path to directory in filestorage
     * @return string
     */
    public function getStoragePath($dir = null)
    {
        $dir = $this->_correctDir($dir);
        if( $dir !== null ) {
            return $this->storagePath . DIRECTORY_SEPARATOR . $dir;
        }
        return $this->storagePath;
    }

    /**
     * Return filestorage URL
     * @return string
     */
    public function getStorageUrl()
    {
        return Url::to([$this->fileRoute, 'name' => '']);
    }

    /**
     * Save file data to DB and return row id if success or false if error
     * @param $path
     * @param $originalName
     * @return bool|int
     */
    private function _saveFileToDB($path, $originalName)
    {
        $path = $this->_correctDir($path);
        $fileModel = new File();
        $fileModel->path = $path;
        $fileModel->original_name = $originalName;
        if( $fileModel->save() ) {
            return $fileModel->id;
        }
        return false;
    }

    /**
     * Generate unique file name
     * @param $baseName
     * @param $extension
     * @return string
     */
    private function _generateUniqueFileName($baseName, $extension)
    {
        $hash = substr(md5($baseName), 0, 5);
        return $hash . uniqid() . ".$extension";
    }

    /**
     * Replace slashes and back slashes to DIRECTORY_SEPARATOR constant
     * @param $dir
     * @return mixed
     */
    private function _correctDir($dir) {
        $dir = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $dir);
        return $dir;
    }
}