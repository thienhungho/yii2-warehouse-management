Yii2 Warehouse Management System
====================
Warehouse Management System for Yii2

Installation
------------

This is just an example, memorible moment. The source code may not work for known reasons. This source code include against loss license feature.

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist thienhungho/yii2-warehouse-management "*"
```

or add

```
"thienhungho/yii2-warehouse-management": "*"
```

to the require section of your `composer.json` file.

Config
------------

Add module WarehouseManage to your `AppConfig` file.

```php
...
'modules'          => [
    ...
        /**
         * Supplier Manage
         */
        'supplier-manage' => [
            'class' => 'thienhungho\SupplierManagement\modules\SupplierManage\SupplierManageModules',
        ],
        /**
         * Supplier Manage
         */
        'employee-manage' => [
            'class' => 'thienhungho\EmployeeManagement\modules\EmployeeManage\EmployeeManageModules',
        ],
        /**
         * Supplier Manage
         */
        'warehouse-manage' => [
            'class' => 'thienhungho\WarehouseManagement\modules\WarehouseManage\WarehouseManageModule',
        ],
        /**
         * Supplier Manage
         */
        'warehouse-voucher-manage' => [
            'class' => 'thienhungho\WarehouseManagement\modules\WarehouseVoucherManage\WarehouseVoucherManageModules',
        ],
    ...
],
...
```

### Migration

Run the following command in Terminal for database migration:

```
yii migrate/up --migrationPath=@vendor/thienhungho/yii2-warehouse-management/migrations
```

Or use the [namespaced migration](http://www.yiiframework.com/doc-2.0/guide-db-migrations.html#namespaced-migrations) (requires at least Yii 2.0.10):

```php
// Add namespace to console config:
'controllerMap' => [
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationNamespaces' => [
            'thienhungho\WarehouseManagement\migrations\namespaced',
        ],
    ],
],
```

Then run:
```
yii migrate/up
```

Modules
------------

[WarehouseBase](https://github.com/thienhungho/yii2-warehouse-management/tree/master/src/modules/WarehouseBase), [WarehouseManage](https://github.com/thienhungho/yii2-warehouse-management/tree/master/src/modules/WarehouseManage),  [WarehouseVoucherManage](https://github.com/thienhungho/yii2-warehouse-management/tree/master/src/modules/WarehouseVoucherManage), 

Functions
------------

[Core](https://github.com/thienhungho/yii2-warehouse-management/tree/master/src/functions/core.php)

Constant
------------

[Core](https://github.com/thienhungho/yii2-warehouse-management/tree/master/src/const/core.php)

Models
------------

[Warehouse](https://github.com/thienhungho/yii2-warehouse-management/tree/master/src/models/Warehouse.php), [WarehouseProduct](https://github.com/thienhungho/yii2-warehouse-management/tree/master/src/models/WarehouseProduct.php), [WarehouseVoucher](https://github.com/thienhungho/yii2-warehouse-management/tree/master/src/models/WarehouseVoucher.php), [WarehouseVoucherItems](https://github.com/thienhungho/yii2-warehouse-management/tree/master/src/models/WarehouseVoucherItems.php)
