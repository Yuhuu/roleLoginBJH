<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ComputerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Computers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="computer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Computer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'serial_id',
            'computer_status',
            'type_id',
            'model',
            'computer_name',
            // 'cpu',
            // 'ram',
            // 'storage_capacity',
            // 'shelf_placement',
            // 'purchase_date',
            // 'warranty_date',
            // 'end_dato',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
