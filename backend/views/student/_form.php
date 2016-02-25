<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use phpexcel\Classes\PHPExcel;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => true])
            ->hint('Please enter the national number')->label('National number')  ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'role')->textInput() ?>
    <?= $form->field($model, 'password')->passwordInput() ?>

   <div class="form-group">
        <?= Html::submitButton('submit', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
