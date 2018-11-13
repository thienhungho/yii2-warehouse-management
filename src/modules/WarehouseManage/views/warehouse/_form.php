<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model thienhungho\WarehouseManagement\modules\WarehouseBase\Warehouse */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="warehouse-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name', [
        'addon' => ['prepend' => ['content' => '<span class="fa fa-user"></span>']],
    ])->textInput([
        'maxlength'   => true,
        'placeholder' => t('app', 'Name'),
    ]) ?>

<!--    --><?//= $form->field($model, 'longitude')->textInput(['maxlength' => true, 'placeholder' => 'Longitude']) ?>
<!---->
<!--    --><?//= $form->field($model, 'latitude')->textInput(['maxlength' => true, 'placeholder' => 'Latitude']) ?>

    <?= $form->field($model, 'address', [
        'addon' => ['prepend' => ['content' => '<span class="fa fa-map-marker"></span>']],
    ])->textarea([
        'maxlength'   => true,
        'placeholder' => t('app', 'Address'),
    ]) ?>

    <?= country_select_input($form, $model) ?>

    <?= $form->field($model, 'city', [
        'addon' => ['prepend' => ['content' => '<span class="fa fa-map-marker"></span>']],
    ])->textInput([
        'maxlength'   => true,
        'placeholder' => 'City',
    ]) ?>

    <?= $form->field($model, 'state', [
        'addon' => ['prepend' => ['content' => '<span class="fa fa-map-marker"></span>']],
    ])->textInput([
        'maxlength'   => true,
        'placeholder' => 'State',
    ]) ?>

    <?= $form->field($model, 'zip_code', [
        'addon' => ['prepend' => ['content' => '<span class="fa fa-map-marker"></span>']],
    ])->textInput([
        'maxlength'   => true,
        'placeholder' => 'Zip Code',
    ]) ?>

    <?= $form->field($model, 'status', [
        'addon' => ['prepend' => ['content' => '<span class="fa fa-eye"></span>']],
    ])->radioButtonGroup([
        STATUS_ACTIVE  => t('app', slug_to_text(STATUS_ACTIVE)),
        'Full stock' => t('app', slug_to_text('Full stock')),
        STATUS_DISABLE => t('app', slug_to_text(STATUS_DISABLE)),
    ], [
        'class'       => 'btn-group-sm',
        'itemOptions' => ['labelOptions' => ['class' => 'btn green']],
    ]); ?>

    <div class="form-group">
    <?php if(Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>
    <?php if(Yii::$app->controller->action->id != 'create'): ?>
        <?= Html::submitButton(Yii::t('app', 'Save As New'), ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
    <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
