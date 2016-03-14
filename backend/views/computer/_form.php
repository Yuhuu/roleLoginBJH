<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Computer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="computer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'serial_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'computer_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_id')->textInput() ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'computer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cpu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ram')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'storage_capacity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shelf_placement')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'purchase_date')->textInput() ?>

    <?= $form->field($model, 'warranty_date')->textInput() ?>

    <?= $form->field($model, 'end_dato')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
