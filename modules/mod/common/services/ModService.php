<?php
/**
 * Created by PhpStorm.
 * User: Oleks
 * Date: 15.01.2019
 * Time: 13:15
 */

namespace modules\mod\common\services;


use modules\mod\backend\models\ModImage;
use modules\mod\common\models\Mod;
use Yii;
use yii\helpers\Url;

class ModService extends Mod
{
  /**
   * @param Mod $modObject
   * @return array
   */
  public static function getFileInputData(Mod $modObject): array
  {
    $imagesIds = $modObject->getImagesIds();
    $imagesUrls = [];
    $initialPreviewConfig = [];
    $imagesOrder = json_decode($modObject->images_order_json);

    for ($i = 0; $i < count($imagesIds); $i++) {
      $imageId = $imagesOrder ? $imagesOrder[$i] : $imagesIds[$i];
      $url = Yii::$app->filestorage->getFileUrl($imageId);
      $imagesUrls[] = $url;
      $initialPreviewConfig[] = [
        'type' => 'image',
        'url' => Url::to(['mod-image/delete-image', 'modId' => $modObject->id]),
        'key' => $imageId,
      ];
    }

    $fileInputData = [
      'imagesUrls' => $imagesUrls,
      'initialPreviewConfig' => $initialPreviewConfig,
    ];

    return $fileInputData;
  }

  /**
   * @param $imagesIds array - ids of images were saved
   * @param $modId integer - for ModImage->entity_id
   * @return array $modImagesData - modImages array and imagesOrder array
   */
  public static function generateModImageObjects($imagesIds, $modId): array
  {
    $modImages = [];
    $imagesOrder = [];
    foreach ($imagesIds as $imageId) {
      $modImage = new ModImage([
        'entity_id' => $modId,
        'image_id' => $imageId
      ]);
      $imagesOrder[] = $imageId;
      $modImage->save();
      $modImages[] = $modImage;
    }

    $modImagesData = [
      'modImages' => $modImages,
      'imagesOrder' => $imagesOrder
    ];

    return $modImagesData;
  }

  /**
   * @param $oldImagesOrder
   * @param $newImagesOrder
   * @return bool - it's true in case, when one or more images were deleted, and false in other case
   */
  public static function deleteExcessImages(array $oldImagesOrder, array $newImagesOrder): bool
  {
    $result = false;

    foreach ($oldImagesOrder as $imageId) {
      if (!in_array($imageId, $newImagesOrder)) {
        $result = true;
        Yii::$app->filestorage->removeFile($imageId);
      }
    }

    return $result;
  }

  /**
   * @param Mod $modObject
   * @return array|bool either array of imagesIds were not deleted or true in case, when every image wal deleted successfully
   */
  public static function deleteImages(Mod $modObject)
  {
    $result = [];

    $imagesIds = $modObject->getImagesIds();
    $oldImagesOrder = json_decode($modObject->images_order_json);
    foreach ($imagesIds as $imageId) {
      if (!Yii::$app->filestorage->removeFile($imageId)) $result[] = $imageId;
    }

    if (count($result) === 0) {
      $modObject->images_order_json = '';
      $result = true;
    } else {
      self::resetImagesOrder($modObject, $result);
      $modObject->addError('deleteMessage', 'One or more images were not deleted!');
    }

    return $result;
  }

  /**
   * @param Mod $modObject
   * @param array|bool $remainingImagesIds
   * @param bool|int $deletedImageId
   */
  public static function resetImagesOrder(Mod $modObject, $remainingImagesIds, $deletedImageId = false)
  {
    $oldOrder = json_decode($modObject->images_order_json);
    $newImagesOrder = $oldOrder;

    if ($remainingImagesIds) {
      foreach ($oldOrder as $index => $imageId) {
        if (!in_array($imageId, $remainingImagesIds)) {
          unset($newImagesOrder[$index]);
        }
      }
    } elseif ($deletedImageId) {
      $deleteIndex = array_search($deletedImageId, $newImagesOrder);
      unset($newImagesOrder[$deleteIndex]);
    }

    sort($newImagesOrder);
    $modObject->images_order_json = json_encode($newImagesOrder);
    $modObject->save(true, ['images_order_json']);
  }
}