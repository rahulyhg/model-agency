Add module to backend\config\main
'banner' => [
  'class' => modules\banner\Module::class,
],

Add component to common\config\main
'banner' => [
  'class' => modules\banner\components\BlockComponent::class,
],

Migration
copy migrations from banner\migrations to console\migrations and do yii migrate
or
yii migrate --migrationPath=@modules/banner/migrations