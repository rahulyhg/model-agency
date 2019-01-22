<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\User;
use Yii;
use yii\rbac\PhpManager;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller {
	/**
	 * {@inheritdoc}
	 */
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => [ 'login', 'error', 'create-one', 'ind' ],
						'allow'   => true,
					],
					[
						'actions' => [ 'logout', 'index' ],
						'allow'   => true,
						'roles'   => [ '@' ],
					],
				],
			],
			'verbs'  => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'logout' => [ 'post' ],
				],
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function actions() {
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex() {
		return $this->render( 'index' );
	}

	/**
	 * Login action.
	 *
	 * @return string
	 */
	public function actionLogin() {
		$this->layout = 'login';

		if ( ! Yii::$app->user->isGuest ) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ( $model->load( Yii::$app->request->post() ) && $model->login() ) {
			return $this->goBack();
		} else {
			$model->password = '';

			return $this->render( 'login', [
				'model' => $model,
			] );
		}
	}

	public function actionCreateOne() {
		if ( ( $model = User::findByUsername( 'admin' ) ) === null ) {
			$model = new User( [ 'username' => 'admin', 'email' => 'test@test.com', 'status' => User::STATUS_ACTIVE, 'auth_key' => 0 ] );
			$model->setPassword( '12345' );
			$model->save();
		}
		$user_id = $model->id;
		$auth    = new PhpManager;
		$auth->init();

		if ( $auth->getAssignment( 'admin', $user_id ) === null ) {
			$role = $auth->getRole( 'admin' );
			if ( $role === null ) {
				$role = $auth->createRole( 'admin' );
				$auth->add( $role );
			}
			$auth->assign( $role, $user_id );
		}

		return $this->redirect( [ 'site/index' ] );
	}

	/**
	 * Logout action.
	 *
	 * @return string
	 */
	public function actionLogout() {
		Yii::$app->user->logout();

		return $this->goHome();
	}
}
