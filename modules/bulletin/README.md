Add module
'bulletin' => [
  'class' => modules\bulletin\Module::class,
],

Migration
copy migrations from bulletin\migrations to console\migrations and do yii migrate
or
yii migrate --migrationPath=@modules/bulletin/migrations

