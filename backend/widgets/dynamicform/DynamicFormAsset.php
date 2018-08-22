<?php

namespace backend\widgets\dynamicform;

/**
 * Asset bundle for dynamicform Widget
 *
 * @author Wanderson Bragança <wanderson.wbc@gmail.com>
 */
class DynamicFormAsset extends \wbraganca\dynamicform\DynamicFormAsset
{
  /**
   * @inheritdoc
   */
  public function init()
  {
    $this->setSourcePath(__DIR__ . '/assets');
    $this->setupAssets('js', ['yii2-dynamic-form']);
    parent::init();
  }
}
