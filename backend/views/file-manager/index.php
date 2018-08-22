<?php
use mihaildev\elfinder\InputFile;
use mihaildev\elfinder\ElFinder;
use yii\web\JsExpression;

/**
 * @var $this \backend\lib\View
 */

mihaildev\elfinder\Assets::noConflict($this);

$this->title = 'File manager';
$this->params['breadcrumbs'][] = $this->title;

echo ElFinder::widget([
	'language'         => 'ru',
	'controller'       => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
	'filter'           => '',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
	'callbackFunction' => new JsExpression('function(file, id){}'), // id - id виджета
	'frameOptions' => [
		'style' => 'height:500px;width:100%;display:block;border:none;'
	],
]);
?>
<hr>
<p><b>Note!</b> If you delete a file that is used in an entity (such as blog post in a visual editor), an error occurs. Be careful!</p>