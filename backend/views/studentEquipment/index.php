<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StudentEquipmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Student Equipments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-equipment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Student Equipment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'student_id',
            'serial_id',
            'borrow_status_id',
            'require_by_teacher_id',
            // 'start_at',
            // 'end_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
