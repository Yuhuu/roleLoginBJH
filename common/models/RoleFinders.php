<?php
namespace common\models;
use yii;
/*
 * Copyright(C) 2016.  All rights reserved to Bjørnholt school. 
 * https://bjornholt.osloskolen.no/
 * @author Created by Bachelor Final Project group 18 at Oslo and Akershus University College 
 * Creating interactive web pages using the Angualr framework carried out by:
 * Martin Hansen Muren Mathisen (s189116), Waqas Liaqat (s180364), 
 * Yuanxin Huang (s184519), Thanh Nguyen Chu (s169954)
 * @version 1.01.01
 */

/**
 * Description of rolefinders
 *
 * @author yuanxinhuang
 */

class RoleFinders
{
/**
* return the value of a role name handed in as string
* example: 'Admin'
*
* @param mixed $role_name
*/
public static function getRoleValue($role_name)
{
$connection = \Yii::$app->db;
$sql = "SELECT role_value FROM role WHERE role_name=:role_name";
$command = $connection->createCommand($sql);
$command->bindValue(":role_name", $role_name);
$result = $command->queryOne();
return $result['role_value'];
}

public static function getStatusValue($status_name)
{
$connection = \Yii::$app->db;
$sql = "SELECT status_value FROM status WHERE status_name=:status_name";
$command = $connection->createCommand($sql);
$command->bindValue(":status_name", $status_name);
$result = $command->queryOne();
return $result['status_value'];
}

/**
* returns value of user_type_name so that you can
* used in PermissionHelpers methods
* handed in as string, example: 'Paid'
*
* @param mixed $user_type_name
*/

public static function getUserTypeValue($user_type_name)
{
$connection = \Yii::$app->db;
$sql = "SELECT student_type_value FROM student_type
WHERE student_type_name=:student_type_name";
$command = $connection->createCommand($sql);
$command->bindValue(":student_type_name", $user_type_name);
$result = $command->queryOne();
return $result['student_type_value'];
}
}