<?php
namespace common\models;

use common\models\RoleFinders;
use yii;
use yii\web\Controller;
use yii\helpers\Url;

/**
* check if the user is the owner of the record. 
* all of these helper methods are public static
* They can be called like PermissionHelpers::requireStudentType(‘lower’);
* use Yii::$app->student->identity->id for $userid, 'string' for model name
*/

class PermissionHelpers {
  /**
   *check if the user is the owner of the record,
   * posts or other records that are visible 
   * to everyone, but only the author can update or delete them and you want to
   * make the navigation visible only to the owner of the record.
   * @param mixed $model_name : the name of model
   * @param mixed $model_id: ("studentEquipment",$model->id))
   */
    public static function userMustBeOwner($model_name, $model_id)
{
    $connection = \Yii::$app->db;
    $userid = Yii::$app->user->identity->id;
    $sql = "SELECT id FROM $model_name WHERE user_id=:userid AND id=:model_id";
    $command = $connection->createCommand($sql);
    $command->bindValue(":userid", $userid);
    $command->bindValue(":model_id", $model_id);
    if($result = $command->queryOne()) {
    return true;
    } else {
    return false;
    }
}
    /**
    * method for compare the student with a certain student type/(higher level or not)
     * This one is not made yet
     * 
     * @param type $user_type_name
     * @return \yii\web\response 
     */
           

       
    public static function requireStudentType($user_type_name)
    {
      if ( Yii::$app->user->identity->student_type_id == 
              ValueHelpers::getUserTypeValue($user_type_name)) {
    return true;
    } else {
    return false;
    }
    }   
    
    // compare the require status and the status
        public static function requireStatus($status_name)
    {
    if ( Yii::$app->user->identity->status_id == 
            ValueHelpers::getStatusValue($status_name)) {
    return true;
    } else {
    return false;
    }
    }
    
    // require role for login
    public static function requireRole($role_name) {
    if ( Yii::$app->user->identity->role_id == ValueHelpers::getRoleValue($role_name)) {
    return true;
    } else {
    return false;
    }
    }
}
