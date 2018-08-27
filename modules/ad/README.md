Add module
'ad' => [
  'class' => modules\ad\Module::class,
],

Migration
copy migrations from ad\migrations to console\migrations and do yii migrate
or
yii migrate --migrationPath=@modules/ad/migrations

