<?php

namespace app\helpers;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;

/**
* @use This helpers class is responsible for all file/File manupulaion process.
* File uploading, croping, resizing etc.
*
* @auther Praveen Kumar
*/
class FileUploader
{
    /**
     * @uses Upload single or multiple File on the server on appropriate path and assign File path to related attribute (column 		to store File path).
     * @return boolean true 
     * @param object $model - model of the File attribute.
     * @param string $fileAttribute - attribute name
     * @param integer $primeryid - unique id used to make unique File name. Use dealer_id for this.
     * @param string  - File type (eg - profileimg, showroomlogo, usedcarFile), Use to decide folder name where File 
		    will be stored.
     */
    public static function uploadFile($model, $fileAttribute)
    {   
        $path = \Yii::$app->params['uploadPath'];

        //removing till upload path as uploads path differs
        $dbPath = str_replace(\Yii::getAlias('@app'), '', $path);

        if (!is_dir($path)) {
            $filePath = BaseFileHelper::createDirectory($path, 0777, true);
        }
        
		if(is_array($model->$fileAttribute))
		{
		    $imgArray = [];
		    foreach($model->$fileAttribute as $file)
		    {
			$fileName = md5($file->baseName . '_' . time());
			$file->saveAs($path .'/'. $fileName . '.' . $file->extension);
			array_push($imgArray,$dbPath . '/' . $fileName . '.' . $file->extension);
		    }
		    $model->$fileAttribute = $imgArray;
		}
		else
		{
		    $fileName = md5($model->$fileAttribute->baseName . '_' . time());
	        $fileSize = ($model->$fileAttribute->size)?(int)$model->$fileAttribute->size/1024:0;
	        
	    	$model->$fileAttribute->saveAs($path .'/'.$fileName . '.' . $model->$fileAttribute->extension);
	        // $newFile = $File->open($path .'/'.$fileName . '.' . $model->$fileAttribute->extension);
	        $model->$fileAttribute = $dbPath . '/' . $fileName . '.' . $model->$fileAttribute->extension;
	        // $model->width = $newFile->getSize()->getWidth();
	        // $model->height = $newFile->getSize()->getHeight();
		}
        return true;
    }
}
