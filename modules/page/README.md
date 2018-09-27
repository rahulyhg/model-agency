Add module to backend\config\main
'page' => [
  'class' => modules\page\Module::class,
]

Migration
copy migrations from page\migrations to console\migrations and do yii migrate
or
yii migrate --migrationPath=@modules/page/migrations