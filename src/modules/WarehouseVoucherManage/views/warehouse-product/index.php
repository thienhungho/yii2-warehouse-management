<?php
/* @var $this yii\web\View */
/* @var $searchModel thienhungho\WarehouseManagement\modules\WarehouseVoucherManage\search\WarehouseProductSearch */

/* @var $dataProvider yii\data\ActiveDataProvider */

use thienhungho\Widgets\models\GridView;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Warehouse Product');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>

<div class="warehouse-product-head">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <div class="col-lg-10">
            <p>
                <?= Html::a(Yii::t('app', 'Create Warehouse Product'), ['create'], ['class' => 'btn btn-success']) ?>
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
<div class="warehouse-product-index">
    <?php
    $gridColumn = [
        ['class' => '\kartik\grid\SerialColumn'],
        [
            'attribute' => 'id',
            'visible'   => false,
        ],
        grid_checkbox_column(),
        [
            'class'     => \kartik\grid\DataColumn::className(),
            'format'    => 'raw',
            'attribute' => 'feature_img',
            'value'     => function($model, $key, $index, $column) {
                return Html::a(
                    '<img style="max-width: 100px;" src=/' . get_other_img_size_path('thumbnail', $model->feature_img) . '>',
                    \yii\helpers\Url::to([
                        'update',
                        $model->id,
                    ]), [
                    'data-pjax' => '0',
                    'target'    => '_blank',
                ]);
            },
            'vAlign'    => GridView::ALIGN_MIDDLE,
        ],
        [
            'attribute' => 'name',
            'vAlign'    => GridView::ALIGN_MIDDLE,
        ],
        [
            'attribute' => 'sku',
            'vAlign'    => GridView::ALIGN_MIDDLE,
        ],
    ];
    $gridColumn[] = grid_view_default_active_column_cofig();
    ?>
    <?= GridView::widget([
        'dataProvider'   => $dataProvider,
        'filterModel'    => $searchModel,
        'columns'        => $gridColumn,
        'hover'          => true,
        'responsive'     => true,
        'responsiveWrap' => false,
        'condensed'      => true,
        'pjax'           => true,
        'pjaxSettings'   => ['options' => ['id' => 'kv-pjax-container-warehouse-product']],
        'panel'          => [
            'type'    => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'toolbar'        => grid_view_toolbar_config($dataProvider, $gridColumn),
    ]); ?>

    <div class="row">
        <div class="col-lg-2">
            <?= \kartik\widgets\Select2::widget([
                'name'    => 'action',
                'value'   => '',
                'data'    => [
                    ACTION_DELETE  => t('app', 'Delete'),
                    STATUS_DRAFT   => t('app', slug_to_text(STATUS_DRAFT)),
                    STATUS_PENDING => t('app', slug_to_text(STATUS_PENDING)),
                    STATUS_PUBLIC  => t('app', slug_to_text(STATUS_PUBLIC)),
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
