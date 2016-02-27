<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\Student;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use backend\models\Equipment;

/**
 * This is the model class for table "student_equipment".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $serial_id
 * @property integer $borrow_status_id
 * @property integer $require_by_teacher_id
 * @property integer $start_at
 * @property integer $end_at
 *
 * @property Equipment $serial
 * @property Student $student
 */
class StudentEquipment extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_equipment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'serial_id', 'borrow_status_id', 'require_by_teacher_id', 'start_at', 'end_at'], 'required'],
            [['student_id', 'serial_id', 'borrow_status_id', 'require_by_teacher_id', 'start_at', 'end_at'], 'integer'],
            [['serial_id'], 'unique'],
            [['serial_id'],'in', 'range'=>array_keys($this->getEquipmentList())],
            [['student_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'serial_id' => 'Serial ID',
            'borrow_status_id' => 'Borrow Status ID',
            'require_by_teacher_id' => 'Require By Teacher ID',
            'start_at' => 'Start At',
            'end_at' => 'End At',
            'equipmentName' => Yii::t('app', 'Equipment'),
            'student_link' => Yii::t('app', 'Student'),
            'student_equipment_link' => Yii::t('app', 'StudentEquipment'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSerial()
    {
        return $this->hasOne(Equipment::className(), ['serial_id' => 'serial_id']);
    }
    public function getEquipmentName()
    {
    return $this->serial->title;
    }
    
    public static function getEquipmentList()
    {
        $droptions = Equipment::find()->asArray()->all();
        return Arrayhelper::map($droptions, 'id', 'title');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }
    
    public function getStudentEmail()
    {
        return $this->student->email;
    }

    public function getStudentId()
    {
    return $this->student ? $this->student->id : 'none';
    }

    /**
    * @getUserLink
    */
    public function getStudentLink()
    {
    $url = Url::to(['Student/view', 'id'=>$this->student_id]);
    $options = [];
    return Html::a($this->getStudentEmail(), $url, $options);
    }
    
    public function getStudentEquipmentLink()
    {
        //why it is update
    $url = Url::to(['StudentEquipment/update', 'id'=>$this->id]);
    $options = [];
    return Html::a($this->id, $url, $options);
    }
    
    /**
    * behaviors to control time stamp, don't forget to use statement for expression
    *
    */
    public function behaviors()
    {
    return [
    'timestamp' => [
    'class' => 'yii\behaviors\TimestampBehavior',
    'attributes' => [
        // this will changes later
    ActiveRecord::EVENT_BEFORE_INSERT => ['start_at', 'end_at'],
    //  ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
    ],
    'value' => new Expression('NOW()'),
        ],
    ];
    }
}
