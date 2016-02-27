<?php

namespace backend\models;

use common\models\Student;
use yii\base\Model;

//use common\models\Student;
/**
 * Signup form
 * Form model to enforce validation rules or other methods
 * data comes in from a controller
 */
class StudentUpload extends StudentCreate {

    public $username;
    public $email;
    public $password;
    public $role;

//    public function rules() {
//        return [
//            ['username', 'filter', 'filter' => 'trim'],
//            ['username', 'required'],
////            Todo
////            ['username', 'unique', 'targetClass' => '\common\models\Student', 'message' => 'This username has already been taken.'],
//            ['username', 'string', 'min' => 2, 'max' => 255],
//            ['email', 'filter', 'filter' => 'trim'],
//            ['email', 'required'],
//            ['email', 'email'],
//            ['email', 'string', 'max' => 255],
////            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
//            ['password', 'required'],
//            ['password', 'string', 'min' => 6],
//            ['role', 'required'],
//            ['role', 'string', 'min' => 2],
//        ];
//    }

    public function getUploadFiledata() {
        try {
//        $objPHPExcel = new \PHPExcel();
            $objPHPExcel = \PHPExcel_IOFactory::load(\Yii::getAlias
                                    ('@webroot/uploads/test.xlsx'));
        } catch (Exception $e) {
            die('Error loading file "');
        }
        $sheetData = $objPHPExcel->getActiveSheet();
        return $sheetData;
        //array data
    }

    public function displayData() {
        $sheetData = $this->getUploadFiledata();
        // Get the highest row number and column letter referenced in the worksheet
        $highestRow = $sheetData->getHighestRow(); // e.g. 12
        $highestColumn = $sheetData->getHighestDataColumn(); // e.g 'I'
        $highestColumn++;

        echo 'Data:<div class="table-responsive"><table class="table">';
        for ($row = 1; $row <= $highestRow; ++$row) {
            echo '<table class="table">';
            for ($col = 'A'; $col <= $highestColumn; ++$col) {
                echo "<tr>";
                if ($col == 'A') {
                    $this->username = $sheetData->getCell($col . $row)
                            ->getValue();
                } elseif ($col == 'B') {
                    $this->password = $sheetData->getCell($col . $row)
                            ->getValue();
                } elseif ($col == 'C') {
                    $this->email = $sheetData->getCell($col . $row)
                            ->getValue();
                } elseif ($col == 'D') {
                    $this->role = $sheetData->getCell($col . $row)
                            ->getValue();
                } else {
                    continue;
                }
            }
            echo "<td>User nummber</td><td>Email</td><td>role nummber</td><td>role pass</td></tr><tr>";
            echo "<td>" . $this->username . "</td><td>" . $this->email . "</td><td>" . $this->role . "</td><td>.$this->password.</td>";
            echo "</tr>";
            echo "</table>";
        }
        echo "</div>";
    }

    public function insertData() {
        $sheetData = $this->getUploadFiledata();
        // Get the highest row number and column letter referenced in the worksheet
        $highestRow = $sheetData->getHighestRow(); // e.g. 12
        $highestColumn = $sheetData->getHighestDataColumn(); // e.g 'I'
        $highestColumn++;
        $bool = false;
        for ($row = 1; $row <= $highestRow; ++$row) {
            for ($col = 'A'; $col <= $highestColumn; ++$col) {    
                if ($col == 'A') {
                    $this->username = $sheetData->getCell($col . $row)->getValue();
                } elseif ($col == 'B') {
                    $this->password = $sheetData->getCell($col . $row)->getValue();
                } elseif ($col == 'C') {
                    $this->email = $sheetData->getCell($col . $row)->getValue();
                } elseif ($col == 'D') {
                    $this->role = $sheetData->getCell($col . $row)->getValue();
                } else {
                    continue;
                }
            }
                 if ($this->signup()) {
                    $bool = true;
            }
        }
         return $bool;
    }
    
      public function signup2() {
            // TODO   add try and catch
            $user = new Student();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->password = $this->password;
            $user->generateAuthKey();
            $user->user_type_id = 10;
            $user->role_id = $this->role;
            $user->created_at = 1;
            $user->updated_at = 1;     
            if ($user->save()) {
                return $user;
            } else {
                return null;
            }  
    }
}
