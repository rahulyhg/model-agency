<?php
/**
 * @var $this \yii\web\View
 * @var $value string
 * @var $label string
 */
?>
<?php if($value) : ?>
<li class="b-features__item-title"><span class="b-features__title"><?= $label ?>:<span class="b-features__title-line b-features__title-line_delay-1"></span></span></li>
<li class="b-features__item-value"><span class="b-features__value"><?= $value ?></span></li>
<?php endif; ?>