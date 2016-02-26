<?php

namespace backend\models;

use common\models\Student;
use yii\base\Model;
use phpexcel\Classes\PHPExcel;
use backend\models\StudentCreate;

//use common\models\Student;
/**
 * Signup form
 * Form model to enforce validation rules or other methods
 * data comes in from a controller
 */
class StudentUpload extends Model {

    public $username;
    public $email;
    public $password;
    public $role;
    public $StudentCreate;

    public function rules() {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Student', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
//            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['role', 'required'],
            ['role', 'string', 'min' => 2],
        ];
    }

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
                if ($col == 'B') {
                    $this->username = $sheetData->getCell($col . $row)
                            ->getValue();
                } elseif ($col == 'D') {
                    $this->password = $sheetData->getCell($col . $row)
                            ->getValue();
                } elseif ($col == 'F') {
                    $this->email = $sheetData->getCell($col . $row)
                            ->getValue();
                } elseif ($col == 'G') {
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
        for ($row = 1; $row <= $highestRow; ++$row) {
            $this->StudentCreate = new StudentCreate();
            for ($col = 'A'; $col <= $highestColumn; ++$col) {    
                if ($col == 'B') {
                    $this->StudentCreate->username = $sheetData->getCell($col . $row)->getValue();
                } elseif ($col == 'D') {
                    $this->StudentCreate->password = $sheetData->getCell($col . $row)->getValue();
                } elseif ($col == 'F') {
                    $this->StudentCreate->email = $sheetData->getCell($col . $row)->getValue();
                } elseif ($col == 'G') {
                    $this->StudentCreate->role = $sheetData->getCell($col . $row)->getValue();
                } else {
                    continue;
                }
            }
//            print_r($this->StudentCreate);
            $this->StudentCreate->signup();
//            if ($this->StudentCreate->signup()) {
//                return true;
//            }
        }
//         return false;
    }

}
