<?php

namespace backend\modules\document\models;

use common\models\DynamicModel;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%document_entity}}".
 *
 * @property int $id
 * @property string $entity
 * @property int $entity_id
 *
 * @property DocumentData[] $documentDatas
 */
class DocumentEntity extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return '{{%document_entity}}';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['entity', 'entity_id'], 'required'],
      [['entity_id'], 'integer'],
      [['entity'], 'string', 'max' => 10],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'entity' => 'Entity',
      'entity_id' => 'Entity ID',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getDocumentDatas()
  {
    return $this->hasMany(DocumentData::class, ['document_entity_id' => 'id']);
  }

  public function validate($attributeNames = null, $clearErrors = true)
  {
    return parent::validate($attributeNames, $clearErrors) &&
    DynamicModel::validateMultiple($this->documentDatas);
  }

  public function load($data, $formName = null)
  {
    parent::load($data, $formName);
    $models = DynamicModel::createMultiple(
      DocumentData::class,
      empty($this->documentDatas) ? [] : $this->documentDatas,
      $data
    );
    $flag = true;
    if (!empty($models)) {
      DynamicModel::loadMultiple($models, $data);
      foreach($models as $i => $model) {
        if(!$model->uploadFile($i)) {
          $flag = false;
        }
      }
    }
    $this->populateRelation('documentDatas', $models);
    return $flag;
  }

  public function save($runValidation = true, $attributeNames = null)
  {
    $db = $this->getDb();
    $tr = $db->beginTransaction();
    try {
      $models = $this->documentDatas;
      if (parent::save($runValidation, $attributeNames)) {
        $notDeletedIds = [];
        foreach ($models as $model) {
          $model->document_entity_id = $this->id;
          if (!$model->save(false)) {
            $tr->rollBack();
            return false;
          }
          $notDeletedIds[] = $model->id;
        }
        if (!$this->isNewRecord) {
         $deleteModels = DocumentData::find()
           ->where(['document_entity_id' => $this->id])
           ->andWhere(['not in', 'id', $notDeletedIds])
           ->all();
          foreach ($deleteModels as $deleteModel) {
            $deleteModel->delete();
          }
        }
        $tr->commit();
        return true;
      }
    } catch (\yii\db\Exception $ex) {
      $tr->rollBack();
    }
    return false;
  }
}
