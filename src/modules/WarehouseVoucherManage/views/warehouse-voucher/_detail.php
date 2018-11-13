<?php

use thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucher;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucher */
?>
<div class="warehouse-voucher-view">

    <div class="row">
        <?php
        $gridColumn = [
            [
                'attribute' => 'id',
                'visible'   => false,
            ],
            'name',
            [
                'attribute' => 'warehouse.name',
                'value'     => function($model, $key) {
                    return Html::a($model->warehouse->name, [
                        '/warehouse-manage/warehouse/view',
                        'id' => $model->warehouse->id,
                    ], [
                        'target'    => '_blank',
                        'data-pjax' => "0",
                    ]);
                },
                'label'     => Yii::t('app', 'Warehouse'),
                'format'    => 'raw',
            ],
            [
                'attribute' => 'employee.id',
                'value'     => function($model, $key) {
                    return Html::a($model->employee->email, [
                        '/employee-manage/employee/view',
                        'id' => $model->employee->id,
                    ], [
                        'target'    => '_blank',
                        'data-pjax' => "0",
                    ]);
                },
                'label'     => Yii::t('app', 'Employee'),
                'format'    => 'raw',
            ],
            [
                'attribute' => 'supplier.name',
                'value'     => function($model, $key) {
                    return Html::a($model->employee->email, [
                        '/supplier-manage/supplier/view',
                        'id' => $model->employee->id,
                    ], [
                        'target'    => '_blank',
                        'data-pjax' => "0",
                    ]);
                },
                'label'     => Yii::t('app', 'Supplier'),
                'format'    => 'raw',
            ],
            'note:ntext',
            'date:date',
            [
                'attribute' => 'total_price',
                'format'    => [
                    'decimal',
                ],
            ],
            [
                'attribute' => 'supplier_total_price',
                'format'    => [
                    'decimal',
                ],
            ],
            'is_locked',
            [
                'attribute' => 'status',
                'value'     => function($model, $key) {
                    if ($model->status === WarehouseVoucher::STATUS_PAID) {
                        return span_label('success', t('app', slug_to_text(WarehouseVoucher::STATUS_PAID)));
                    } elseif ($model->status === WarehouseVoucher::STATUS_UNPAID) {
                        return span_label('danger', t('app', slug_to_text(WarehouseVoucher::STATUS_UNPAID)));
                    }
                },
                'format'    => 'raw',
            ],
            [
                'attribute' => 'type',
                'value'     => function($model, $key) {
                    if ($model->type === 'input') {
                        return span_label('success', t('app', slug_to_text('input')));
                    } elseif ($model->type === 'output') {
                        return span_label('danger', t('app', slug_to_text('output')));
                    }
                },
                'format'    => 'raw',
            ],
            'is_total_price_correct',
            [
                'attribute' => 'attachments',
                'value'     => function($model, $key) {
                    $content = null;
                    if (!empty($model->attachments)) {
                        $attachments = json_decode($model->attachments);
                        foreach ($attachments as $attach) {
                            $thumbnail_img = get_other_img_size_path('thumbnail', $attach);
                            $content .= <<<HTML
<a href="/$attach" target="_blank" data-pjax="0" style="display: inline-block; margin: 2px"><img src="/$thumbnail_img" style="max-width: 60px;"></a>
HTML;

                        }
                    }

                    return $content;
                },
                'label'     => Yii::t('app', 'Attachments'),
                'format'    => 'raw',
            ],
        ];
        echo DetailView::widget([
            'model'      => $model,
            'attributes' => $gridColumn,
        ]);
        ?>
    </div>
</div>