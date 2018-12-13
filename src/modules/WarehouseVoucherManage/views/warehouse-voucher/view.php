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
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Warehouse Voucher').' '. Html::encode($this->title) ?></h2>
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
        'name',
        [
            'attribute' => 'warehouse.name',
            'label' => Yii::t('app', 'Warehouse'),
        ],
        [
            'attribute' => 'employee.id',
            'label' => Yii::t('app', 'Employee'),
        ],
        [
            'attribute' => 'supplier.name',
            'label' => Yii::t('app', 'Supplier'),
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
        <h4>Employee<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnEmployee = [
        ['attribute' => 'id', 'visible' => false],
        'user_id',
        'avatar',
        'first_name',
        'last_name',
        'phone',
        'email',
        'website',
        'birth_date',
        'gender',
        'relationship_status',
        'vat_number',
        'language',
        'address',
        'country',
        'city',
        'state',
        'zip_code',
        'date_join',
        'date_left',
        'status',
        'type',
        'currency',
    ];
    echo DetailView::widget([
        'model' => $model->employee,
        'attributes' => $gridColumnEmployee    ]);
    ?>
    <div class="row">
        <h4>Supplier<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnSupplier = [
        ['attribute' => 'id', 'visible' => false],
        'user_id',
        'avatar',
        'name',
        'phone',
        'email',
        'website',
        'birth_date',
        'gender',
        'relationship_status',
        'vat_number',
        'language',
        'address',
        'country',
        'city',
        'state',
        'zip_code',
        'date_join',
        'date_left',
        'status',
        'type',
        'currency',
    ];
    echo DetailView::widget([
        'model' => $model->supplier,
        'attributes' => $gridColumnSupplier    ]);
    ?>
    <div class="row">
        <h4>Warehouse<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnWarehouse = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'longitude',
        'latitude',
        'address',
        'country',
        'city',
        'state',
        'zip_code',
        'status',
    ];
    echo DetailView::widget([
        'model' => $model->warehouse,
        'attributes' => $gridColumnWarehouse    ]);
    ?>
    
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-warehouse-voucher-items']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Warehouse Voucher Items')),
        ],
        'columns' => $gridColumnWarehouseVoucherItems
    ]);
}
?>

    </div>
</div>
