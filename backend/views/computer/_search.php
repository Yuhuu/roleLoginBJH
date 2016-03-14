<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ComputerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="computer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'serial_id') ?>

    <?= $form->field($model, 'computer_status') ?>

    <?= $form->field($model, 'type_id') ?>

    <?= $form->field($model, 'model') ?>

    <?= $form->field($model, 'computer_name') ?>

    <?php // echo $form->field($model, 'cpu') ?>

    <?php // echo $form->field($model, 'ram') ?>

    <?php // echo $form->field($model, 'storage_capacity') ?>

    <?php // echo $form->field($model, 'shelf_placement') ?>

    <?php // echo $form->field($model, 'purchase_date') ?>

    <?php // echo $form->field($model, 'warranty_date') ?>

    <?php // echo $form->field($model, 'end_dato') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
