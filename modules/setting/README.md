Add module to backend\config\main
'setting' => [
  'class' => modules\setting\Module::class,
],

Add component to common\config\main
'setting' => [
  'class' => modules\setting\components\SettingComponent::class,
],

Migration
copy migrations from setting\migrations to console\migrations and do yii migrate
or
yii migrate --migrationPath=@modules/setting/migrations