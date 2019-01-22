<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 30.05.2018
 * Time: 17:12
 */

namespace backend\controllers;


use backend\lib\Controller;

class FileManagerController extends Controller {
	public function actionIndex()
	{
		return $this->render('index');
	}
}