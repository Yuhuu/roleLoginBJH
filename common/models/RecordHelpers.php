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
 * Description of If ($already_exists = RecordHelpers::userHas('studentEquipment') {
    // show profile with id with value of $already_exists
    } else {
        // go to do something else
        }   
 *
 * @author yuanxinhuang
 */
class RecordHelpers {
    //to see whether the student has rent some equipment
    
    public static function userHas($model_name)
{
$connection = \Yii::$app->db;
$userid = Yii::$app->user->identity->id;

$sql = "SELECT id FROM $model_name WHERE user_id=:userid";
$command = $connection->createCommand($sql);
$command->bindValue(":userid", $userid);
$result = $command->queryOne();
if ($result == null) {
return false;
} else {
return $result['id'];
}
}
}
