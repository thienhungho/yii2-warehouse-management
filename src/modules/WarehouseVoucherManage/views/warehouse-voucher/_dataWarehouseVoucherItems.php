<?php

use thienhungho\Widgets\models\GridView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->warehouseVoucherItems,
    'key'       => 'id',
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'attribute' => 'id',
        'visible'   => false,
    ],
    [
        'attribute' => 'warehouseProduct.name',
        'label'     => Yii::t('app', 'Warehouse Product'),
    ],
    [
        'attribute' => 'productUnit.name',
        'label'     => Yii::t('app', 'Product Unit'),
    ],
    'product_unit_price',
    'currency_unit',
    'quantity',
    'supplier_total_price',
    'total_price',
    [
        'class'      => 'yii\grid\ActionColumn',
        'controller' => 'warehouse-voucher-items',
    ],
];
echo GridView::widget([
    'dataProvider'     => $dataProvider,
    'columns'          => $gridColumns,
    'containerOptions' => ['style' => 'overflow: auto'],
    'pjax'             => true,
    'beforeHeader'     => [
        [
            'options' => ['class' => 'skip-export'],
        ],
    ],
    'export'           => [
        'fontAwesome' => true,
    ],
    'bordered'         => true,
    'striped'          => true,
    'condensed'        => true,
    'responsive'       => true,
    'hover'            => true,
    'showPageSummary'  => false,
    'persistResize'    => false,
]);
