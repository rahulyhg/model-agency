<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $searchModelAlias = $searchModelClass . 'Search';
}

/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use <?= ltrim($generator->modelClass, '\\') ?>;
<?php if (!empty($generator->searchModelClass)): ?>
    use <?= ltrim($generator->searchModelClass, '\\') . (isset($searchModelAlias) ? " as $searchModelAlias" : "") ?>;
<?php else: ?>
    use yii\data\ActiveDataProvider;
<?php endif; ?>
use <?= ltrim($generator->baseControllerClass, '\\') ?>;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/**
* <?= $controllerClass ?> implements the CRUD actions for <?= $modelClass ?> model.
*/
class <?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . "\n" ?>
{
    /**
    * {@inheritdoc}
    */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
    * Lists all <?= $modelClass ?> models.
    * @return mixed
    */
    public function actionIndex()
    {
<?php if (!empty($generator->searchModelClass)): ?>
        $searchModel = new <?= isset($searchModelAlias) ? $searchModelAlias : $searchModelClass ?>();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        ]);
<?php else: ?>
        $dataProvider = new ActiveDataProvider([
        'query' => <?= $modelClass ?>::find(),
        ]);

        return $this->render('index', [
        'dataProvider' => $dataProvider,
        ]);
<?php endif; ?>
    }

    /**
    * Creates a new <?= $modelClass ?> model.
    * If creation is successful, the browser will be redirected to the 'update' page.
    * @return mixed
    */
    public function actionCreate()
    {
        $model = new <?= $modelClass ?>();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Запись успешно создана. ' . Html::a(
                '<span><i class="la la-plus"></i><span>Новая запись</span></span>',
                ['create'],
                ['class' => 'btn btn-sm btn-accent m-btn--pill m-btn--icon m-btn--air']
            ));
            return $this->redirect(['update', <?= $urlParams ?>]);
        }

        return $this->render('create', [
        'model' => $model,
        ]);
    }

    /**
    * Updates an existing <?= $modelClass ?> model.
    * If update is successful, the browser will be redirected to the 'update' page.
    * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
    * @return mixed
    * @throws NotFoundHttpException if the model cannot be found
    */
    public function actionUpdate(<?= $actionParams ?>)
    {
        $model = $this->findModel(<?= $actionParams ?>);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success','Запись успешно обновлена.');
            return $this->redirect(['update', <?= $urlParams ?>]);
        }

        return $this->render('update', [
        'model' => $model,
        ]);
    }

    /**
    * Deletes an existing <?= $modelClass ?> model.
    * If deletion is successful, the browser will be redirected to the 'index' page.
    * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
    * @return mixed
    * @throws NotFoundHttpException if the model cannot be found
    */
    public function actionDelete(<?= $actionParams ?>)
    {
        $model = $this->findModel(<?= $actionParams ?>);
        if($model->delete()) {
            Yii::$app->session->setFlash('success', "Запись #$id успешно удалена.");
        }
        if(!empty($model->getErrors('deleteMessage'))) {
            Yii::$app->session->setFlash('error', $model->getErrors('deleteMessage'));
        }
        return $this->redirect(['index']);
    }

    /**
    * Deletes an existing <?= $modelClass ?> models.
    * If deletion is successful, the browser will be redirected to the 'index' page.
    * @return \yii\web\Response
    * @throws \yii\web\BadRequestHttpException
    * @throws NotFoundHttpException
    */
    public function actionMultipleDelete()
    {
        if ($ids = Yii::$app->request->post('ids')) {
            $count = 0;
            $errorMessages = [];
            foreach ($this->findModels($ids) as $model) {
                if ($model->delete() !== false) {
                    $count++;
                } else {
                    if(!empty($model->getErrors('deleteMessage'))) {
                        $errorMessages = array_merge($errorMessages, $model->getErrors('deleteMessage'));
                    } else {
                        $errorMessages = array_merge($errorMessages, ["Ошибка при удалении записи #$model->id."]);
                    }
                }
            }
            if(!empty($errorMessages)) {
                Yii::$app->session->setFlash('error', $errorMessages);
            }
            if ($count > 0) {
                $message = '{n, plural, =1{Выбранная запись успешно удалена} few{Выбранные # записи успешно удалены} many{Выбранные # записей успешно удалены} other{Выбранные # записи успешно удалены}}.';
                Yii::$app->session->setFlash('success', \MessageFormatter::formatMessage('ru', $message, ['n' => $count]));
            }
            return $this->redirect(['index']);
        }
        throw new \yii\web\BadRequestHttpException();
    }

    /**
    * Finds the <?= $modelClass ?> model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
    * @return <?=                   $modelClass ?> the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModel(<?= $actionParams ?>)
    {
<?php
if (count($pks) === 1) {
    $condition = '$id';
} else {
    $condition = [];
    foreach ($pks as $pk) {
        $condition[] = "'$pk' => \$$pk";
    }
    $condition = '[' . implode(', ', $condition) . ']';
}
?>
        if (($model = <?= $modelClass ?>::findOne(<?= $condition ?>)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(<?= $generator->generateString('The requested page does not exist.') ?>);
    }

    /**
    * @param $ids
    * @return <?= $modelClass ?>[]
    * @throws NotFoundHttpException
    */
    protected function findModels($ids)
    {
        $models = <?= $modelClass ?>::findAll($ids);
        if (!empty($models)) {
            return $models;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}