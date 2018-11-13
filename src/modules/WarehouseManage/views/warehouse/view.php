<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model thienhungho\WarehouseManagement\modules\WarehouseBase\Warehouse */
$this->title = $model->name;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Warehouse'),
    'url'   => ['index'],
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Warehouse') . ' ' . Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
            <?=
            Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'),
                [
                    'pdf',
                    'id' => $model->id,
                ],
                [
                    'class'       => 'btn btn-danger',
                    'target'      => '_blank',
                    'data-toggle' => 'tooltip',
                    'title'       => Yii::t('app', 'Will open the generated PDF file in a new window'),
                ]
            ) ?>
            <?= Html::a(Yii::t('app', 'Save As New'), [
                'save-as-new',
                'id' => $model->id,
            ], ['class' => 'btn btn-info']) ?>
            <?= Html::a(Yii::t('app', 'Update'), [
                'update',
                'id' => $model->id,
            ], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), [
                'delete',
                'id' => $model->id,
            ], [
                'class' => 'btn btn-danger',
                'data'  => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method'  => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            [
                'attribute' => 'id',
                'visible'   => false,
            ],
            'name',
            'longitude',
            'latitude',
            'address:ntext',
            'country',
            'city',
            'state',
            'zip_code',
            'status',
        ];
        echo DetailView::widget([
            'model'      => $model,
            'attributes' => $gridColumn,
        ]);
        ?>
    </div>
</div>
