<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
Yii::$app->theme->registerThemeAsset($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= Yii::$app->theme->getAssetsUrl($this) ?>/img/favicon.ico" type="image/x-icon" />
    <title><?= Html::encode($this->title) ?></title>
    <meta name="description" content="<?= $this->params['meta_description'] ?>">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<!-- b-page -->
<section class="b-page" data-tracking-place>

    <!-- .b-header -->
    <?= $this->render('_header'); ?>
    <!-- b-header -->

    <!-- b-main -->
    <main class="b-main b-page__main">
        <div class="b-main__row">

            <?= $content ?>

        </div>
    </main>
    <!-- b-main end -->

    <!-- b-footer -->
    <?= $this->render('_footer'); ?>
    <!-- b-footer end -->

</section>
<!-- b-page end -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
