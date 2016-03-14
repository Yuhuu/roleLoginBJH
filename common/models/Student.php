<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $role_id
 * @property integer $user_type_id
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $class_nr
 *
 * @property StudentEquipment $studentEquipment
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            [['role_id', 'user_type_id', 'status_id', 'created_at', 'updated_at', 'class_nr'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'role_id' => 'Role ID',
            'user_type_id' => 'User Type ID',
            'status_id' => 'Status ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'class_nr' => 'Class Nr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentEquipment()
    {
        return $this->hasOne(StudentEquipment::className(), ['student_id' => 'id']);
    }
}
