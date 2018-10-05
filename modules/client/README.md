Add module
'client' => [
  'class' => modules\client\Module::class,
],

Migration
copy migrations from client\migrations to console\migrations and do yii migrate
or
yii migrate --migrationPath=@modules/client/migrations

