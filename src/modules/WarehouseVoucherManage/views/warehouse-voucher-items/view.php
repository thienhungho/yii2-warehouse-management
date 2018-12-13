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
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Warehouse Voucher Items').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'), 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            )?>
            <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>            
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
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
    <div class="row">
        <h4>ProductUnit<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnProductUnit = [
        ['attribute' => 'id', 'visible' => false],
        'name',
    ];
    echo DetailView::widget([
        'model' => $model->productUnit,
        'attributes' => $gridColumnProductUnit    ]);
    ?>
    <div class="row">
        <h4>WarehouseProduct<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnWarehouseProduct = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'feature_img',
        'sku',
        'description',
    ];
    echo DetailView::widget([
        'model' => $model->warehouseProduct,
        'attributes' => $gridColumnWarehouseProduct    ]);
    ?>
    <div class="row">
        <h4>WarehouseVoucher<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnWarehouseVoucher = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'warehouse_id',
        'employee_id',
        'supplier_id',
        'note',
        'date',
        'is_locked',
        'status',
        'type',
        'attachments',
    ];
    echo DetailView::widget([
        'model' => $model->warehouseVoucher,
        'attributes' => $gridColumnWarehouseVoucher    ]);
    ?>
</div>
