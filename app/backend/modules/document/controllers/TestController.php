<?php

namespace backend\modules\document\controllers;

use backend\modules\document\forms\DocumentForm;
use common\models\DynamicModel;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Test controller for the `document` module
 */
class TestController extends Controller
{

  public function actionSingle()
  {
    $documentForm = new DocumentForm();
    if(Yii::$app->request->isPost) {
      $documentForm->file = UploadedFile::getInstance($documentForm, 'file');
      if($documentForm->upload()){
        Yii::$app->session->setFlash('success', 'Success!');
        return $this->refresh();
      }
    }
    return $this->render('single', ['dynamicModel' => $documentForm]);
  }

  public function actionRepeater()
  {
    $documentForms = [new DocumentForm(), new DocumentForm()];
    if(Yii::$app->request->isPost) {
      $documentForms = DynamicModel::createMultiple(DocumentForm::class);
      $flag = true;
      foreach($documentForms as $i => $documentForm) {
        $documentForm->file = UploadedFile::getInstance($documentForm, "[$i]file");
        $flag = $documentForm->upload($i);
        if (!$flag) {
          break;
        }
      }
      if($flag) {
        Yii::$app->session->setFlash('success', 'Success!');
        return $this->refresh();
      }
    }
    return $this->render('repeater', ['models' => $documentForms]);
  }

  public function actionDynamicform()
  {
    $documentForms = [new DocumentForm()];
    if(Yii::$app->request->isPost) {
      $documentForms = DynamicModel::createMultiple(DocumentForm::class);
      $flag = true;
      foreach($documentForms as $i => $documentForm) {
        $documentForm->file = UploadedFile::getInstance($documentForm, "[$i]file");
        $flag = $documentForm->upload($i);
        if (!$flag) {
          break;
        }
      }
      if($flag) {
        Yii::$app->session->setFlash('success', 'Success!');
        if(Yii::$app->request->isPjax) {
          return $this->render('dynamicform', ['models' => $documentForms]);
        }
        return $this->refresh();
      }
    }
    return $this->render('dynamicform', ['models' => $documentForms]);
  }
}
