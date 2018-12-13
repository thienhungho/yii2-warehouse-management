<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use thienhungho\Widgets\models\GridView;

/* @var $this yii\web\View */
/* @var $model thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucherItems */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Warehouse Voucher Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-voucher-items-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Warehouse Voucher Items').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'warehouseVoucher.name',
                'label' => Yii::t('app', 'Warehouse Voucher')
            ],
        [
                'attribute' => 'warehouseProduct.name',
                'label' => Yii::t('app', 'Warehouse Product')
            ],
        [
                'attribute' => 'productUnit.name',
                'label' => Yii::t('app', 'Product Unit')
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
