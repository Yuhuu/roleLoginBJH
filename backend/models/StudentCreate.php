<?php
namespace backend\models;

use common\models\Student;
use yii\base\Model;
use Yii;

/**
 * Signup form
 * Form model to enforce validation rules or other methods
 * data comes in from a controller
 */
class StudentCreate extends Model
{
    public $username;
    public $email;
    public $password;
    public $role;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
//            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
//            ['email', 'email'],
            ['email', 'string', 'max' => 255],
//            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            
            ['role', 'required'],
            ['role', 'string', 'min' => 2]
        ];
    }

    /**
     * Signs student up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        
//        This helpe Student uoload to validate data
//        if ($this->validate()) {
            $user = new Student();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->user_type_id = 10;
            $user->role_id = $this->role;
            $user->created_at = 1;
            $user->updated_at = 1;
          
//            $user->save();
        if ($user->save()) {
            return $user;
        } else {
//        }
            return null;
        }
    }
}
