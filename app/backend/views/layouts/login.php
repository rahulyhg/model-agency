<?php

/* @var $this \backend\lib\View */

/* @var $content string */

use backend\assets\AppAsset;
use backend\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register( $this );
Yii::$app->metronic->registerThemeAsset( $this );
\common\components\metronic\LoginAsset::register( $this );
$this->registerJs( 'WebFont.load({
  google: {"families":["Roboto:300,400,500,600,700","Roboto:300,400,500,600,700"]},
  active: function() {
      sessionStorage.fonts = true;
  }
});', \yii\web\View::POS_HEAD );
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
  <title><?= Html::encode( $this->title ) ?></title>
	<?php $this->head() ?>
</head>
<body
    class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<?php $this->beginBody() ?>


<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">


  <?= $content ?>


</div>
<!-- end:: Page -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
