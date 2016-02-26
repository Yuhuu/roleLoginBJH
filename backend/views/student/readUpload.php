<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model common\models\StudentUpload */

$this->title = 'Create Student and empolyee';
$this->params['breadcrumbs'][] = ['label' => 'Students and employee', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">

 <h1><?= Html::encode($this->title) ?></h1>
 <?php $form = ActiveForm::begin(); ?>
 <?php   
//        $model = new StudentUpload();
  $model->displayData();
 ?>
  <?php 
  $model->insertData();
  ?>



   <div class="form-group">
        <?= Html::submitButton('Yes, want to insert to database', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
