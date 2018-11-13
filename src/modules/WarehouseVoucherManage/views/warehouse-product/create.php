<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseProduct */

$this->title = Yii::t('app', 'Create Warehouse Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Warehouse Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
