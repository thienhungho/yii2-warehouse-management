<?php
/* @var $this yii\web\View */
/* @var $searchModel thienhungho\WarehouseManagement\modules\WarehouseVoucherManage\search\WarehouseVoucherSearch */

/* @var $dataProvider yii\data\ActiveDataProvider */

use thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucher;
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Warehouse Voucher');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>

<div class="warehouse-voucher-head">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-10">
            <p>
                <?= Html::a(Yii::t('app', 'Create Warehouse Voucher'), ['create'], ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('app', 'Advance Search'), '#', ['class' => 'btn btn-info search-button']) ?>
            </p>
        </div>
        <div class="col-lg-2">
            <p>
            <form method="get">
                <?= \kartik\widgets\Select2::widget([
                    'name'    => 'per-page',
                    'value'   => '',
                    'data'    => [
                        5   => 5 . ' ' . t('app', 'Items Per Page'),
                        15  => 15 . ' ' . t('app', 'Items Per Page'),
                        25  => 25 . ' ' . t('app', 'Items Per Page'),
                        55  => 55 . ' ' . t('app', 'Items Per Page'),
                        100 => 100 . ' ' . t('app', 'Items Per Page'),
                    ],
                    'theme'   => \kartik\widgets\Select2::THEME_BOOTSTRAP,
                    'options' => [
                        'multiple'    => false,
                        'placeholder' => t('app', 'Per Page ...'),
                        'onchange'    => 'this.form.submit()',
                    ],
                ]); ?>
            </form>
            </p>
        </div>
    </div>
    <div class="search-form" style="display:none">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>
</div>

<?= Html::beginForm(['bulk']) ?>
<div class="warehouse-voucher-index">
    <?php
    $gridColumn = [
        ['class' => '\kartik\grid\SerialColumn'],
        grid_checkbox_column(),
        [
            'class'         => 'kartik\grid\ExpandRowColumn',
            'width'         => '50px',
            'value'         => function($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail'        => function($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'expandOneOnly' => true,
        ],
        [
            'attribute' => 'id',
            'visible'   => false,
        ],
        [
            'attribute'     => 'name',
            'headerOptions' => ['style' => 'min-width:250px;'],
            'pageSummary' => Yii::t('app', 'Total'),
        ],
        [
            'attribute'           => 'warehouse_id',
            'label'               => Yii::t('app', 'Warehouse'),
            'value'               => function($model) {
                return $model->warehouse->name;
            },
            'filterType'          => GridView::FILTER_SELECT2,
            'filter'              => \yii\helpers\ArrayHelper::map(\thienhungho\WarehouseManagement\modules\WarehouseBase\Warehouse::find()
                ->select([
                    'id',
                    'name',
                ])->asArray()->all(), 'id', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions'  => [
                'placeholder' => Yii::t('app','Warehouse'),
                'id'          => 'grid-warehouse-voucher-search-warehouse_id',
            ],
        ],
        [
            'attribute'           => 'employee_id',
            'format'              => 'raw',
            'label'               => Yii::t('app', 'Employee'),
            'value'               => function($model) {
                return '<a href="mailto:' . $model->employee->email . '">' . $model->employee->email . '</a>';
            },
            'filterType'          => GridView::FILTER_SELECT2,
            'filter'              => \yii\helpers\ArrayHelper::map(\thienhungho\EmployeeManagement\modules\EmployeeBase\Employee::find()
                ->select([
                    'id',
                    'email',
                ])
                ->asArray()
                ->all(), 'id', 'email'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions'  => [
                'placeholder' => Yii::t('app','Employee'),
                'id'          => 'grid-warehouse-voucher-search-employee_id',
            ],
        ],
        [
            'attribute'           => 'supplier_id',
            'label'               => Yii::t('app', 'Supplier'),
            'value'               => function($model) {
                return $model->supplier->name;
            },
            'filterType'          => GridView::FILTER_SELECT2,
            'filter'              => \yii\helpers\ArrayHelper::map(\thienhungho\SupplierManagement\models\Supplier::find()
                ->asArray()
                ->all(), 'id', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions'  => [
                'placeholder' => Yii::t('app','Supplier'),
                'id'          => 'grid-warehouse-voucher-search-supplier_id',
            ],
        ],
        [
            'format'        => [
                'date',
                'php:Y-m-d h:s:i',
            ],
            'attribute'     => 'date',
            'filterType'    => GridView::FILTER_DATETIME,
            'headerOptions' => ['style' => 'min-width:150px;'],
        ],
        [
            'attribute' => 'total_price',
            'format'    => [
                'decimal',
            ],
            'pageSummary' => true
        ],
        [
            'attribute' => 'supplier_total_price',
            'format'    => [
                'decimal',
            ],
            'pageSummary' => true
        ],
        [
            'class' => 'kartik\grid\FormulaColumn',
            'header' => Yii::t('app', 'Difference Value'),
            'value' => function ($model, $key, $index, $widget) {
                return $model->supplier_total_price - $model->total_price;
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'hAlign' => 'right',
            'format' => ['decimal'],
            'mergeHeader' => true,
            'pageSummary' => true,
            'footer' => true
        ],
        [
            'attribute'           => 'is_locked',
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'label'               => Yii::t('app', 'Locked'),
            'class'               => '\kartik\grid\BooleanColumn',
            'trueLabel'           => Yii::t('app', 'Is Locked'),
            'falseLabel'          => Yii::t('app', 'Is not Locked'),
        ],
        [
            'format'              => 'raw',
            'attribute'           => 'status',
            'value'               => function($model, $key, $index, $column) {
                if ($model->status === WarehouseVoucher::STATUS_PAID) {
                    return span_label('success', t('app', slug_to_text(WarehouseVoucher::STATUS_PAID)));
                } elseif ($model->status === WarehouseVoucher::STATUS_UNPAID) {
                    return span_label('danger', t('app', slug_to_text(WarehouseVoucher::STATUS_UNPAID)));
                }
            },
            'filterType'          => GridView::FILTER_SELECT2,
            'filter'              => \yii\helpers\ArrayHelper::map([
                [
                    'value' => STATUS_ACTIVE,
                    'name'  => t('app', slug_to_text(STATUS_ACTIVE)),
                ],
                [
                    'value' => WarehouseVoucher::STATUS_UNPAID,
                    'name'  => t('app', slug_to_text(WarehouseVoucher::STATUS_UNPAID)),
                ],
            ], 'value', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions'  => [
                'placeholder' => Yii::t('app', 'Status'),
                'id'          => 'grid-search-status',
            ],
        ],
        [
            'format'              => 'raw',
            'attribute'           => 'type',
            'value'               => function($model, $key, $index, $column) {
                if ($model->type === 'input') {
                    return span_label('success', t('app', slug_to_text('input')));
                } elseif ($model->type === 'output') {
                    return span_label('danger', t('app', slug_to_text('output')));
                }
            },
            'filterType'          => GridView::FILTER_SELECT2,
            'filter'              => \yii\helpers\ArrayHelper::map([
                [
                    'value' => 'input',
                    'name'  => t('app', slug_to_text('input')),
                ],
                [
                    'value' => 'output',
                    'name'  => t('app', slug_to_text('output')),
                ],
            ], 'value', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions'  => [
                'placeholder' => Yii::t('app', 'Type'),
                'id'          => 'grid-search-type',
            ],
        ],
    ];
    $gridColumn[] = grid_view_default_active_column_cofig();
    ?>
    <?= GridView::widget([
        'dataProvider'   => $dataProvider,
        'filterModel'    => $searchModel,
        'columns'        => $gridColumn,
        'responsive'     => true,
        'responsiveWrap' => false,
        'hover'          => true,
        'condensed'      => true,
        'pjax'           => true,
        'pjaxSettings'   => ['options' => ['id' => 'kv-pjax-container-warehouse-voucher']],
        'panel'          => [
            'type'    => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'toolbar'        => grid_view_toolbar_config($dataProvider, $gridColumn),
        'showPageSummary' => true
    ]); ?>

    <div class="row">
        <div class="col-lg-2">
            <?= \kartik\widgets\Select2::widget([
                'name'    => 'action',
                'value'   => '',
                'data'    => [
                    ACTION_DELETE                   => t('app', 'Delete'),
                    WarehouseVoucher::STATUS_PAID   => t('app', slug_to_text(WarehouseVoucher::STATUS_PAID)),
                    WarehouseVoucher::STATUS_UNPAID => t('app', slug_to_text(WarehouseVoucher::STATUS_UNPAID)),
                    'locked'                        => t('app', slug_to_text('locked')),
                    'un locked'                     => t('app', slug_to_text('un locked')),
                ],
                'theme'   => \kartik\widgets\Select2::THEME_BOOTSTRAP,
                'options' => [
                    'multiple'    => false,
                    'placeholder' => t('app', 'Bulk Actions ...'),
                ],
            ]); ?>
        </div>
        <div class="col-lg-10">
            <?= Html::submitButton(t('app', 'Apply'), [
                'class'        => 'btn btn-primary',
                'data-confirm' => t('app', 'Are you want to do this?'),
            ]) ?>
        </div>
    </div>

</div>
