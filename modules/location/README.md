Add module
'location' => [
  'class' => modules\location\Module::class,
],

Migration
copy migrations from location\migrations to console\migrations and do yii migrate
or
yii migrate --migrationPath=@modules/location/migrations

