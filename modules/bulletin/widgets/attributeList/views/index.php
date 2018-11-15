<?php
/**
 * @var $this \yii\web\View
 * @var $list array
 * @var $elementClass string
 */
?>
<ul class="b-single-announcemen__params <?= $elementClass ?>">
  <?php foreach ($list as $key => $val) : ?>
  <li class="b-single-announcemen__params-item">
    <span class="b-single-announcemen__params-name"><?= $key ?></span>
    <span class="b-single-announcemen__params-value"><?= $val ?></span>
  </li>
  <?php endforeach; ?>
</ul>
