<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use thienhungho\Widgets\models\GridView;

/* @var $this yii\web\View */
/* @var $model thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucherItems */

?>
<div class="warehouse-voucher-items-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'warehouseVoucher.name',
            'label' => Yii::t('app', 'Warehouse Voucher'),
        ],
        [
            'attribute' => 'warehouseProduct.name',
            'label' => Yii::t('app', 'Warehouse Product'),
        ],
        [
            'attribute' => 'productUnit.name',
            'label' => Yii::t('app', 'Product Unit'),
        ],
        'product_unit_price',
        'currency_unit',
        'quantity',
        'supplier_total_price',
        'total_price',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>