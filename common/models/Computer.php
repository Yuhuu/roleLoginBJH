<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "computer".
 *
 * @property string $serial_id
 * @property string $computer_status
 * @property integer $type_id
 * @property string $model
 * @property string $computer_name
 * @property string $cpu
 * @property string $ram
 * @property string $storage_capacity
 * @property string $shelf_placement
 * @property string $purchase_date
 * @property string $warranty_date
 * @property string $end_dato
 */
class Computer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'computer';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serial_id'], 'required'],
            [['type_id'], 'integer'],
            [['purchase_date', 'warranty_date', 'end_dato'], 'safe'],
            [['serial_id'], 'string', 'max' => 250],
            [['computer_status', 'model', 'computer_name', 'cpu', 'ram', 'storage_capacity', 'shelf_placement'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'serial_id' => 'Serial ID',
            'computer_status' => 'Computer Status',
            'type_id' => 'Type ID',
            'model' => 'Model',
            'computer_name' => 'Computer Name',
            'cpu' => 'Cpu',
            'ram' => 'Ram',
            'storage_capacity' => 'Storage Capacity',
            'shelf_placement' => 'Shelf Placement',
            'purchase_date' => 'Purchase Date',
            'warranty_date' => 'Warranty Date',
            'end_dato' => 'End Dato',
        ];
    }
}
