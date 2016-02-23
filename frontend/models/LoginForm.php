<?php
namespace frontend\models;
/*
 * Copyright(C) 2016.  All rights reserved to Bjørnholt school. 
 * https://bjornholt.osloskolen.no/
 * @author Created by Bachelor Final Project group 18 at Oslo and Akershus University College 
 * Creating interactive web pages using the Angualr framework carried out by:
 * Martin Hansen Muren Mathisen (s189116), Waqas Liaqat (s180364), 
 * Yuanxin Huang (s184519), Thanh Nguyen Chu (s169954)
 * @version 1.01.01
 */
use Yii;
use yii\base\Model;
use common\models\Student;
/**
 * Description of newPHPClass
 *
 * @author yuanxinhuang
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            //['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate() && $this->getUser()) {
            return Yii::$app->user->login($this->getUser(), 
                    $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds student object instance by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Student::findByUsername($this->username);
        }

        return $this->_user;
    }
}
