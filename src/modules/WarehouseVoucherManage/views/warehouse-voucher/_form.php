<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use \thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucher;

/* @var $this yii\web\View */
/* @var $model thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucher */
/* @var $form yii\widgets\ActiveForm */
\mootensai\components\JsBlock::widget([
    'viewFile'   => '_script',
    'pos'        => \yii\web\View::POS_END,
    'viewParams' => [
        'class'       => 'WarehouseVoucherItems',
        'relID'       => 'warehouse-voucher-items',
        'value'       => \yii\helpers\Json::encode($model->warehouseVoucherItems),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0,
    ],
]);
?>

<div class="row warehouse-voucher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <div class="col-lg-8 col-sm-12">

        <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

        <?= $form->field($model, 'name', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-user"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => t('app', 'Name'),
        ]) ?>

        <?= $form->field($model, 'date')->widget(\kartik\widgets\DateTimePicker::classname(), [
            'options' => [
                'pluginOptions' => [
                    'placeholder' => Yii::t('app', 'Choose Date'),
                    'autoclose'   => true,
                ],
            ],
        ]); ?>

        <?= $form->field($model, 'warehouse_id', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-map-marker"></span>']],
        ])->widget(\kartik\widgets\Select2::classname(), [
            'data'          => \yii\helpers\ArrayHelper::map(\thienhungho\WarehouseManagement\modules\WarehouseBase\Warehouse::find()
                ->select([
                    'id',
                    'name',
                ])
                ->orderBy('id')
                ->asArray()
                ->all(), 'id', 'name'),
            'options'       => ['placeholder' => Yii::t('app', 'Choose Warehouse')],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(Yii::t('app', 'Warehouse')); ?>

        <?= $form->field($model, 'total_price', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-money"></span>']],
        ])->widget(\kartik\number\NumberControl::classname(), [
            'value'              => 1000,
            'maskedInputOptions' => [
                'prefix' => ' ',
                'suffix' => ' ',
                'digits' => 2,
            ],
            'displayOptions'     => ['class' => 'form-control kv-monospace'],
            'saveInputContainer' => ['class' => 'kv-saved-cont'],
            'readonly'           => true,
        ]) ?>

        <?= $form->field($model, 'supplier_total_price', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-money"></span>']],
        ])->widget(\kartik\number\NumberControl::classname(), [
            'value'              => 1000,
            'maskedInputOptions' => [
                'prefix' => ' ',
                'suffix' => ' ',
                'digits' => 2,
            ],
            'displayOptions'     => ['class' => 'form-control kv-monospace'],
            'saveInputContainer' => ['class' => 'kv-saved-cont'],
        ]) ?>

        <?php
        $gallery = [];
        if (!empty($model->attachments)) {
            $galleries = json_decode($model->attachments);
            foreach ($galleries as $g) {
                $gallery[] = '/' . $g;
            }
        }
        echo $form->field($model, 'attachments[]')->fileInput()
            ->widget(\kartik\file\FileInput::classname(), [
                'options'       => [
                    'accept'   => 'image/*',
                    'multiple' => true,
                ],
                'pluginOptions' => empty($model->attachments) ? [] : [
                    'initialPreview'       => $gallery,
                    'initialPreviewAsData' => true,
                    'initialCaption'       => count($gallery) . 'Item',
                    'overwriteInitial'     => true,
                ],
            ]);
        ?>

    </div>

    <div class="col-lg-4 col-sm-12" style="margin-top: 14px">

        <?= $form->field($model, 'employee_id', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-map-marker"></span>']],
        ])->widget(\kartik\widgets\Select2::classname(), [
            'data'          => \yii\helpers\ArrayHelper::map(\thienhungho\EmployeeManagement\modules\EmployeeBase\Employee::find()
                ->select([
                    'id',
                    'email',
                ])
                ->orderBy('id')
                ->asArray()
                ->all(), 'id', 'email'),
            'options'       => ['placeholder' => Yii::t('app', 'Choose Employee')],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(Yii::t('app', 'Employee')); ?>

        <?= $form->field($model, 'supplier_id', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-map-marker"></span>']],
        ])->widget(\kartik\widgets\Select2::classname(), [
            'data'          => \yii\helpers\ArrayHelper::map(\BaseApp\warehouse\modules\SupplierBase\Supplier::find()
                ->select([
                    'id',
                    'name',
                ])->orderBy('id')
                ->asArray()
                ->all(), 'id', 'name'),
            'options'       => ['placeholder' => Yii::t('app', 'Choose Supplier')],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(Yii::t('app', 'Supplier')); ?>

        <?= $form->field($model, 'is_locked', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-eye"></span>']],
        ])->radioButtonGroup([
            true  => Yii::t('app', slug_to_text('Yes')),
            false => Yii::t('app', slug_to_text('No')),
        ], [
            'class'       => 'btn-group-sm',
            'itemOptions' => ['labelOptions' => ['class' => 'btn green']],
        ]); ?>

        <?= $form->field($model, 'status', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-eye"></span>']],
        ])->radioButtonGroup([
            WarehouseVoucher::STATUS_PAID  => t('app', slug_to_text(WarehouseVoucher::STATUS_PAID)),
            WarehouseVoucher::STATUS_UNPAID => t('app', slug_to_text(WarehouseVoucher::STATUS_UNPAID)),
        ], [
            'class'       => 'btn-group-sm',
            'itemOptions' => ['labelOptions' => ['class' => 'btn green']],
        ]); ?>

        <?= $form->field($model, 'type', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-eye"></span>']],
        ])->radioButtonGroup([
            WarehouseVoucher::TYPE_IN_PUT  => t('app', slug_to_text(WarehouseVoucher::TYPE_IN_PUT)),
            WarehouseVoucher::TYPE_OUT_PUT => t('app', slug_to_text(WarehouseVoucher::TYPE_OUT_PUT)),
        ], [
            'class'       => 'btn-group-sm',
            'itemOptions' => ['labelOptions' => ['class' => 'btn green']],
        ]); ?>

        <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
    </div>

    <div class="col-lg-12 col-sm-12">

        <?php
        $forms = [
            [
                'label'   => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'WarehouseVoucherItems')),
                'content' => $this->render('_formWarehouseVoucherItems', [
                    'row' => \yii\helpers\ArrayHelper::toArray($model->warehouseVoucherItems),
                ]),
            ],
        ];
        echo kartik\tabs\TabsX::widget([
            'items'         => $forms,
            'position'      => kartik\tabs\TabsX::POS_ABOVE,
            'encodeLabels'  => false,
            'pluginOptions' => [
                'bordered'    => true,
                'sideways'    => true,
                'enableCache' => false,
            ],
        ]);
        ?>

    </div>

    <div class="col-lg-12 col-sm-12">
        <div class="form-group">
            <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?><?php endif; ?><?php if (Yii::$app->controller->action->id != 'create'): ?>
                <?= Html::submitButton(Yii::t('app', 'Save As New'), [
                    'class' => 'btn btn-info',
                    'value' => '1',
                    'name'  => '_asnew',
                ]) ?><?php endif; ?>
            <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
