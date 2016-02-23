<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('upload excel file', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
             'email:email',
             'role_id',
            // 'user_type_id',
            // 'status_id',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

<div class="form">
 
<?php
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'service-form',
    'enableAjaxValidation'=>false,
    'method'=>'post',
    'type'=>'horizontal',
    'htmlOptions'=>array(
        'enctype'=>'multipart/form-data'
    )
)); ?>
 
    <fieldset>
        <legend>
            <p class="note">Fields with <span class="required">*</span> are required.</p>
        </legend>
 
        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class'=>'alert alert-error span12')); ?>
 
        <div class="control-group">     
            <div class="span4">
                                <div class="control-group <?php if ($model->hasErrors('postcode')) echo "error"; ?>">
        <?php echo $form->labelEx($model,'file'); ?>
        <?php echo $form->fileField($model,'file'); ?>
        <?php echo $form->error($model,'file'); ?>
                            </div>
 
 
            </div>
        </div>
 
        <div class="form-actions">
            <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'UPLOAD')); ?>
            <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
        </div>
 
    </fieldset>
 
<?php $this->endWidget(); ?>
 
</div><!-- form -->
