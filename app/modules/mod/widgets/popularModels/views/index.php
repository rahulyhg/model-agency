<?php
/**
 * @var $this \yii\web\View
 * @var $elementClass string
 * @var $mods \modules\mod\common\models\Mod[]
 */
use yii\helpers\Url;
?>
<div class="b-our-models <?= $elementClass ?>">
  <div class="b-our-models__items">
    <?php foreach ($mods as $model) :
      /**
       * @var $model \modules\mod\common\models\Mod
       */
      ?>
      <div class="b-our-model b-our-models__item">
        <a href="<?= Url::to(['/mod/model/view', 'id' => $model->id]) ?>" class="b-our-model__box" style="background-image: url('<?= $model->modUser->photoUrl ?: Yii::$app->theme->getAssetsUrl($this) . '/img/default-model-photo.jpg' ?>')">
          <img class="b-our-model__img"
               alt="<?= "{$model->full_name}" ?>"
               src="<?= $model->modUser->photoUrl ?: Yii::$app->theme->getAssetsUrl($this) . '/img/default-model-photo.jpg' ?>">
          <h2 class="b-our-model__name"><?= "{$model->full_name}" ?></h2>
          <div class="b-our-model__id"><?= $model->id ?></div>
        </a>
        <div class="b-our-model__footer">
          <?= \modules\like\widgets\like\Like::widget([
            'options' => [
              'class' => 'b-our-model__like'
            ],
            'entityId' => $model->id
          ]) ?>
        </div>
      </div>
    <?php  endforeach; ?>
  </div>
</div>
