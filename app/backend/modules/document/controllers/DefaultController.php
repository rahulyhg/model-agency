<?php

namespace backend\modules\document\controllers;

use backend\modules\document\forms\DocumentForm;
use backend\modules\document\models\Document;
use backend\modules\document\models\DocumentData;
use backend\modules\document\models\DocumentEntity;
use backend\modules\document\traits\ModuleTrait;
use common\models\DynamicModel;
use Yii;
use yii\base\Model;
use yii\db\Exception;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * Default controller for the `document` module
 */
class DefaultController extends Controller
{
  use ModuleTrait;

  /**
   * Create a document.
   *
   * @param $entity string encrypt entity
   *
   * @return array
   */
  public function actionCreate($entity)
  {
    $entityAttributes = $this->getDocumentAttributesFromEntity($entity);

    $model = DocumentEntity::findOne(['entity' => $entityAttributes['entity'], 'entity_id' => $entityAttributes['entity_id']]);
    if ($model === null) {
      $model = new DocumentEntity(['entity' => $entityAttributes['entity'], 'entity_id' => $entityAttributes['entity_id']]);
    }

    if ($model->load(Yii::$app->request->post()) && $model->save()) {

    }
    return $this->render('@backend/modules/document/widgets/views/index', [
      'models' => $model->documentDatas ? : [new DocumentData()],
      'encryptedEntity' => $entity,
    ]);
  }

  protected function saveDocuments($models, $entityAttributes)
  {
    $tr = Yii::$app->db->beginTransaction();
    try {
      $notDeletedIds = [];
      foreach ($models as $model) {
        /**
         * @var $model Document
         */
        $model->setAttributes($entityAttributes);
        if (!$model->save(false)) {
          $tr->rollBack();
          return false;
        }
        $notDeletedIds[] = $model->id;
      }
      Document::deleteAll([
        'and',
        ['not in', 'id', $notDeletedIds],
        ['entity' => $entityAttributes['entity'], 'entity_id' => $entityAttributes['entity_id']]
      ]);
      $tr->commit();

    } catch (Exception $e) {
      $tr->rollBack();
      return false;
    }
    return true;
  }

  /**
   * Get list of attributes from encrypted entity
   *
   * @param $entity string encrypted entity
   *
   * @return array|mixed
   *
   * @throws BadRequestHttpException
   */
  protected function getDocumentAttributesFromEntity($entity)
  {
    $decryptEntity = Yii::$app->getSecurity()->decryptByKey(utf8_decode($entity), $this->getModule()->id);
    if ($decryptEntity !== false) {
      return Json::decode($decryptEntity);
    }

    throw new BadRequestHttpException('Oops, something went wrong. Please try again later.');
  }
}
