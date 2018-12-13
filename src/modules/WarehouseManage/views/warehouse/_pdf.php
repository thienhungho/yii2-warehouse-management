<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use thienhungho\Widgets\models\GridView;

/* @var $this yii\web\View */
/* @var $model thienhungho\WarehouseManagement\modules\WarehouseBase\Warehouse */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Warehouse'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Warehouse').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
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
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
