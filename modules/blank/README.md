Add module
'blank' => [
  'class' => modules\blank\Module::class,
],

Migration
copy migrations from modules\blank\migrations to console\migrations and do yii migrate
or
yii migrate --migrationPath=@modules/blank/migrations

