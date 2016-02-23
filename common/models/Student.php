<?php
/**
* @link http://www.yiiframework.com/
* @copyright Copyright (c) 2008 Yii Software LLC
* @license http://www.yiiframework.com/license/
*/
namespace common\models;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;
use yii\helpers\Security;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\Role;
use backend\models\Status;
use backend\models\StudentType;
use backend\models\StudentEquipment;

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
 */
class Student extends ActiveRecord implements IdentityInterface{
    
    const STATUS_ACTIVE = 10;
    const ROLE_STUDENT = 10;
    const ROLE_TEACHER = 20;
    
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'student';
    }
/**
* behaviors
*/
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['role_id', 'user_type_id', 'status_id', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
  //          [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            ['username', 'filter', 'filter' => 'trim'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            ['status_id', 'default', 'value' => self::STATUS_ACTIVE],
            [['status_id'],'in', 'range'=>array_keys($this->getStatusList())],
            ['role_id', 'default', 'value' => 10],
            [['role_id'],'in', 'range'=>array_keys($this->getRoleList())],
            ['user_type_id', 'default', 'value' => 10],
            [['user_type_id'],'in', 'range'=>array_keys($this->getUserTypeList())],
//            ['username', 'string', 'min' => 2, 'max' => 255]
            // have a range of values enforced for entries one the role id column
          
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Username',
//            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'role_id' => 'Role ID',
            'user_type_id' => 'User Type ID (student: 10, teacher: 20, Admin :30)',
            'status_id' => 'Status ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'roleName' => Yii::t('app', 'Role'),
            'statusName' => Yii::t('app', 'Status'),
            'profileId'=> Yii::t('app', 'StudentEquipment'),
            'profileLink' => Yii::t('app', 'StudentEquipment'),
            //'studentLink' => Yii::t('app', 'Student'),
            'studentIdLink'=> Yii::t('app', 'Student'),
            'userTypeName' => Yii::t('app', 'StudentType'),
            'userTypeId'=> Yii::t('app', 'StudentType'),
            
        ];
    }
    /**
    * @findIdentity  Identity Methods
    */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status_id' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status_id' => self::STATUS_ACTIVE]);
    }
    
    
    public static function isUserStudent($username)
    {
          if (static::findOne(['username' => $username, 'role_id' => self::ROLE_STUDENT])){
                 return true;
          } else {
                 return false;
          }

    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status_id' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password: not change it.
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    /**
    * get role 
    *
    */
    public function getRole()
    {
    return $this->hasOne(Role::className(), ['role_value' => 'role_id']);
    }
    
    public function getRoleName()
    {
    return $this->role ? $this->role->role_name : '- no role -';
    }
    
    // if we want this function to work , add use yii\helpers\ArrayHelper;
    // and uncomment the one of rule about getrolelist
    //this model only to accept role_id values that are in the range of the
    // role_value in the role table
    public static function getRoleList()
    {
        //this is good function when we want a angular multi select 
    $droptions = Role::find()->asArray()->all();
    return Arrayhelper::map($droptions, 'role_value', 'role_name');
    }
    
    /**
    * get status relation
    *
    */
    public function getStatus()
    {
    return $this->hasOne(Status::className(), ['status_value' => 'status_id']);
    }
    
    public function getStatusName()
    {
    return $this->status ? $this->status->status_name : '- no status -';
    }
   
//    get list of statuses for dropdown
    public static function getStatusList()
    {
    $droptions = Status::find()->asArray()->all();
    return Arrayhelper::map($droptions, 'status_value', 'status_name');
    }
    
    public function getUserType()
    {
    return $this->hasOne(StudentType::className(), ['student_type_value' =>
    'user_type_id']);
    }
    
    public function getUserTypeName()
    {
    return $this->userType ? $this->userType->student_type_name : '- no user type -';
    }
    
    public static function getUserTypeList()
    {
    $droptions = StudentType::find()->asArray()->all();
    return Arrayhelper::map($droptions, 'student_type_value', 'student_type_name');
    }
    
    // use this function usertype above
    public function getUserTypeId()
    {
    return $this->userType ? $this->userType->id : 'none';
    }
    
    public function getProfile()
    {
    return $this->hasOne(StudentEquipment::className(), ['student_id' => 'id']);
    }

    public function getProfileId()
    {
    return $this->profile ? $this->profile->id : 'none';
    }

    public function getProfileLink()
    {
    $url = Url::to(['StudentEquipment/view', 'id'=>$this->profileId]);
    $options = [];
    return Html::a($this->profile ? 'profile' : 'none', $url, $options);
    }

    public function getStudentIdLink()
    {
    $url = Url::to(['student/update', 'id'=>$this->id]);
    $options = [];
    return Html::a($this->id, $url, $options);
    }

    public function getStudentEmail()
    {
        $url = Url::to(['student/view', 'id'=>$this->id]);
    $options = [];
    return Html::a($this->email, $url, $options);
    }
    

}