Add module to backend\config\main
'user' => [
  'class' => modules\user\Module::class,
],

Migration
copy migrations from user\migrations to console\migrations and do yii migrate
or
yii migrate --migrationPath=@modules/user/migrations