Add module to backend\config\main
'menu' => [
  'class' => modules\menu\Module::class,
]

Migration
copy migrations from menu\migrations to console\migrations and do yii migrate
or
yii migrate --migrationPath=@modules/menu/migrations