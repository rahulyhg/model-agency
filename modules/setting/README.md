Add component
'setting' => [
  'class' => modules\setting\components\SettingComponent::class,
],

Migration
copy migrations from setting\migrations to console\migrations and do yii migrate
or
yii migrate --migrationPath=@modules/setting/migrations