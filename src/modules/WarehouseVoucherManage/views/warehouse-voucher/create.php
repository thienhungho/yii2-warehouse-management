<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucher */

$this->title = Yii::t('app', 'Create Warehouse Voucher');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Warehouse Voucher'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-voucher-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
