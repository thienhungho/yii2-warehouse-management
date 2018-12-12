<div class="form-group" id="add-warehouse-voucher-items">
    <?php

    use kartik\builder\TabularForm;
    use kartik\grid\GridView;
    use yii\data\ArrayDataProvider;
    use yii\helpers\Html;

    $dataProvider = new ArrayDataProvider([
        'allModels'  => $row,
        'pagination' => [
            'pageSize' => -1,
        ],
    ]);
    echo TabularForm::widget([
        'dataProvider'      => $dataProvider,
        'formName'          => 'WarehouseVoucherItems',
        'checkboxColumn'    => false,
        'actionColumn'      => false,
        'attributeDefaults' => [
            'type' => TabularForm::INPUT_TEXT,
        ],
        'attributes'        => [
            "id"                     => [
                'type'          => TabularForm::INPUT_HIDDEN,
                'columnOptions' => ['hidden' => true],
            ],
            'product_feature_img' => [
                'label' => Yii::t('app', 'Feature Img'),
                'type'  => TabularForm::INPUT_RAW,
                'value' => function($model, $key) {
                    if (!empty($model['warehouse_product'])) {
                        $product = \thienhungho\WarehouseManagement\models\WarehouseProduct::find()
                            ->select('feature_img')
                            ->where(['id' => $model['warehouse_product']])
                            ->asArray()
                            ->one();

                        return html_img('/' . get_other_img_size_path('thumbnail', $product['feature_img']), ['style' => 'max-width: 100px']);
                    }

                    return html_img('/' . DEFAULT_FEATURE_IMG, ['style' => 'max-width: 100px']);
                },
                'columnOptions' => ['vAlign' => GridView::ALIGN_MIDDLE],
            ],
            'warehouse_product'      => [
                'label'         => Yii::t('app', 'Warehouse product'),
                'type'          => TabularForm::INPUT_WIDGET,
                'widgetClass'   => \kartik\widgets\Select2::className(),
                'options'       => [
                    'data'    => \yii\helpers\ArrayHelper::map(\thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseProduct::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => Yii::t('app', 'Choose Warehouse product')],
                ],
                'columnOptions' => ['width' => '400px', 'vAlign' => GridView::ALIGN_MIDDLE],
            ],
            'quantity'               => [
                'label'       => Yii::t('app', 'Quantity'),
                'type'        => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\number\NumberControl::classname(),
                'options'     => [
                    'maskedInputOptions' => [
                        'prefix' => ' ',
                        'suffix' => ' ',
                        'digits' => 2,
                    ],
                    'displayOptions'     => ['class' => 'form-control kv-monospace'],
                    'saveInputContainer' => ['class' => 'kv-saved-cont'],
                ],
                'columnOptions' => ['vAlign' => GridView::ALIGN_MIDDLE],
            ],
            'supplier_quantity'      => [
                'label'       => Yii::t('app', 'Supplier Quantity'),
                'type'        => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\number\NumberControl::classname(),
                'options'     => [
                    'maskedInputOptions' => [
                        'prefix' => ' ',
                        'suffix' => ' ',
                        'digits' => 2,
                    ],
                    'displayOptions'     => ['class' => 'form-control kv-monospace'],
                    'saveInputContainer' => ['class' => 'kv-saved-cont'],
                ],
                'columnOptions' => ['vAlign' => GridView::ALIGN_MIDDLE],
            ],
            'product_unit'           => [
                'label'         => Yii::t('app', 'Product unit'),
                'type'          => TabularForm::INPUT_WIDGET,
                'widgetClass'   => \kartik\widgets\Select2::className(),
                'options'       => [
                    'data'    => \yii\helpers\ArrayHelper::map(\thienhungho\ProductManagement\models\ProductUnit::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => Yii::t('app', 'Choose Product unit')],
                ],
                'columnOptions' => ['width' => '120px', 'vAlign' => GridView::ALIGN_MIDDLE],
            ],
            'product_unit_price'     => [
                'label'         => Yii::t('app', 'Product unit price'),
                'type'          => TabularForm::INPUT_WIDGET,
                'widgetClass'   => \kartik\number\NumberControl::classname(),
                'options'       => [
                    'maskedInputOptions' => [
                        'prefix' => ' ',
                        'suffix' => ' ',
                        'digits' => 2,
                    ],
                    'displayOptions'     => ['class' => 'form-control kv-monospace'],
                    'saveInputContainer' => ['class' => 'kv-saved-cont'],
                ],
                'columnOptions' => ['width' => '150px', 'vAlign' => GridView::ALIGN_MIDDLE],
            ],
            'currency_unit'          => [
                'label'         => Yii::t('app', 'Currency unit'),
                'type'          => TabularForm::INPUT_WIDGET,
                'widgetClass'   => \kartik\widgets\Select2::className(),
                'options'       => [
                    'data'    => get_all_currency_code(),
                    'options' => ['placeholder' => Yii::t('app', 'Choose currency unit')],
                ],
                'columnOptions' => ['width' => '150px', 'vAlign' => GridView::ALIGN_MIDDLE],
            ],
            'supplier_total_price'   => [
                'label'         => Yii::t('app', 'Supplier total price'),
                'type'          => TabularForm::INPUT_WIDGET,
                'widgetClass'   => \kartik\number\NumberControl::classname(),
                'options'       => [
                    'maskedInputOptions' => [
                        'prefix' => ' ',
                        'suffix' => ' ',
                        'digits' => 2,
                    ],
                    'displayOptions'     => ['class' => 'form-control kv-monospace'],
                    'saveInputContainer' => ['class' => 'kv-saved-cont'],
                ],
                'columnOptions' => ['width' => '150px', 'vAlign' => GridView::ALIGN_MIDDLE],
            ],
            'total_price'            => [
                'label'         => Yii::t('app', 'Total Price'),
                'type'          => TabularForm::INPUT_WIDGET,
                'widgetClass'   => \kartik\number\NumberControl::classname(),
                'options'       => [
                    'maskedInputOptions' => [
                        'prefix' => ' ',
                        'suffix' => ' ',
                        'digits' => 2,
                    ],
                    'readonly'           => true,
                    'displayOptions'     => ['class' => 'form-control kv-monospace'],
                    'saveInputContainer' => ['class' => 'kv-saved-cont'],
                ],
                'columnOptions' => ['width' => '150px', 'vAlign' => GridView::ALIGN_MIDDLE],
            ],
            'is_total_price_correct' => [
                'type'  => 'raw',
                'label' => Yii::t('app', 'Is Total Price Correct?'),
                'value' => function($model, $key) {
                    if (!empty($model['total_price']) && !empty($model['supplier_total_price'])) {
                        if ($model['total_price'] === $model['supplier_total_price']) {
                            return '<span style="color: green; font-weight: bold">' . Yii::t('app', 'Correct') . '</span>';
                        }

                        return '<span style="color: red; font-weight: bold">' . Yii::t('app', 'Wrong') . '</span>';
                    }

                    return '<span style="color: gray; font-weight: bold">' . Yii::t('app', 'Not calculated') . '</span>';
                },
                'columnOptions' => ['vAlign' => GridView::ALIGN_MIDDLE],
            ],
            'is_quantity_correct'    => [
                'type'  => 'raw',
                'label' => Yii::t('app', 'Is Quantity Correct?'),
                'value' => function($model, $key) {
                    if (!empty($model['quantity']) && !empty($model['supplier_quantity'])) {
                        if ($model['quantity'] === $model['supplier_quantity']) {
                            return '<span style="color: green; font-weight: bold">' . Yii::t('app', 'Correct') . '</span>';
                        }

                        return '<span style="color: red; font-weight: bold">' . Yii::t('app', 'Wrong') . '</span>';
                    }

                    return '<span style="color: gray; font-weight: bold">' . Yii::t('app', 'Not calculated') . '</span>';
                },
                'columnOptions' => ['vAlign' => GridView::ALIGN_MIDDLE],
            ],
            'del'                    => [
                'type'  => 'raw',
                'label' => '',
                'value' => function($model, $key) {
                    return
                        Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                        Html::a('<span class="btn btn-xs red" style="margin-bottom: 1px; margin-top: 1px"><span class="fa fa-times"></span></span>', '#', [
                            'title'   => Yii::t('app', 'Delete'),
                            'onClick' => 'delRowWarehouseVoucherItems(' . $key . '); return false;',
                            'id'      => 'warehouse-voucher-items-del-btn',
                        ]);
                },
                'columnOptions' => ['vAlign' => GridView::ALIGN_MIDDLE],
            ],
        ],
        'gridSettings'      => [
            'responsiveWrap' => false,
            'condensed'      => true,
            'hover'          => true,
            'panel' => [
                'heading' => false,
                'type'    => GridView::TYPE_DEFAULT,
                'before'  => false,
                'footer'  => false,
                'after'   => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Warehouse Voucher Items'), [
                    'type'    => 'button',
                    'class'   => 'btn btn-success kv-batch-create',
                    'onClick' => 'addRowWarehouseVoucherItems()',
                ]),
            ],
        ],
    ]);
    echo "    </div>\n\n";
    ?>

