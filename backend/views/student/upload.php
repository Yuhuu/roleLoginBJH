<?php

use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;



/* @var $this yii\web\View */
/* @var $model common\models\Studentupload */

$this->title = 'Create Student and empolyee';
$this->params['breadcrumbs'][] = ['label' => 'Students and employee', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-upload">

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'file')->fileInput() ?>

<button>Submit</button>

<?php ActiveForm::end() ?>
</div>

       


   

    

