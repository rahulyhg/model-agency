Add module
'lang' => [
  'class' => modules\lang\Module::class,
],

Migration
copy migrations from lang\migrations to console\migrations and do yii migrate
or
yii migrate --migrationPath=@modules/lang/migrations

