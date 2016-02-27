<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;



/* @var $this yii\web\View */
/* @var $model common\models\Studentcreate */

$this->title = 'Create Student and empolyee';
$this->params['breadcrumbs'][] = ['label' => 'Students and employee', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
