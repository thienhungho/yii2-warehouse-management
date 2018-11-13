<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucherItems */

$this->title = Yii::t('app', 'Create Warehouse Voucher Items');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Warehouse Voucher Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-voucher-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
