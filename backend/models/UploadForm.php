<?php 
namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
  public function rules()
{
    return [
        [['file'], 'file'],
    ];
}

public function upload()
    {
        if ($this->validate()) {
            $this->file->saveAs('uploads/test.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }
}