<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use thienhungho\Widgets\models\GridView;

/* @var $this yii\web\View */
/* @var $model thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucher */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Warehouse Voucher'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-voucher-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Warehouse Voucher').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        [
                'attribute' => 'warehouse.name',
                'label' => Yii::t('app', 'Warehouse')
            ],
        [
                'attribute' => 'employee.id',
                'label' => Yii::t('app', 'Employee')
            ],
        [
                'attribute' => 'supplier.name',
                'label' => Yii::t('app', 'Supplier')
            ],
        'note:ntext',
        'date',
        'is_locked',
        'status',
        'type',
        'attachments:ntext',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerWarehouseVoucherItems->totalCount){
    $gridColumnWarehouseVoucherItems = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
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
    echo Gridview::widget([
        'dataProvider' => $providerWarehouseVoucherItems,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Warehouse Voucher Items')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnWarehouseVoucherItems
    ]);
}
?>
    </div>
</div>
