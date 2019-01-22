Add module to backend\config\main
'block' => [
  'class' => modules\block\Module::class,
],

Add component to common\config\main
'block' => [
  'class' => modules\block\components\BlockComponent::class,
],

Migration
copy migrations from block\migrations to console\migrations and do yii migrate
or
yii migrate --migrationPath=@modules/block/migrations