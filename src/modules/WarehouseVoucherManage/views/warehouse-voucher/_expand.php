<?php

use kartik\tabs\TabsX;
use yii\helpers\Html;

$items = [
    [
        'label'   => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'WarehouseVoucher')),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
    [
        'label'   => '<i class="glyphicon glyphicon-shopping-cart"></i> ' . Html::encode(Yii::t('app', 'Warehouse Voucher Items')),
        'content' => $this->render('_dataWarehouseVoucherItems', [
            'model' => $model,
            'row'   => $model->warehouseVoucherItems,
        ]),
    ],
];
echo TabsX::widget([
    'items'         => $items,
    'position'      => TabsX::POS_ABOVE,
    'encodeLabels'  => false,
    'class'         => 'tes',
    'pluginOptions' => [
        'bordered'    => true,
        'sideways'    => true,
        'enableCache' => false,
    ],
]);