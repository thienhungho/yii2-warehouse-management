<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseProduct */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="warehouse-product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name', [
        'addon' => ['prepend' => ['content' => '<span class="fa fa-edit"></span>']],
    ])->textInput([
        'maxlength'   => true,
        'placeholder' => t('app', 'Name'),
    ]) ?>

    <?= $form->field($model, 'sku', [
        'addon' => ['prepend' => ['content' => '<span class="fa fa-barcode"></span>']],
    ])->textInput([
        'maxlength'   => true,
        'placeholder' => t('app', 'Sku'),
    ]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'feature_img')->fileInput()
        ->widget(\kartik\file\FileInput::classname(), [
            'options'       => ['accept' => 'image/*'],
            'pluginOptions' => empty($model->feature_img) ? [] : [
                'initialPreview'       => [
                    '/' . $model->feature_img,
                ],
                'initialPreviewAsData' => true,
                'initialCaption'       => $model->feature_img,
                'overwriteInitial'     => true,
            ],
        ]);
    ?>

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
