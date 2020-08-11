<?php

namespace app\helpers;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
// use yii\imagine\Image;
// use Imagine\Gd;
// use Imagine\Image\Box;
// use Imagine\Image\BoxInterface;

/**
* @use This helpers class is responsible for all file/image manupulaion process.
* image uploading, croping, resizing etc.
*
* @auther Praveen Kumar
*/
class ImageUploader
{
    /**
     * @uses Upload single or multiple image on the server on appropriate path and assign image path to related attribute (column 		to store image path).
     * @return boolean true 
     * @param object $model - model of the image attribute.
     * @param string $fileAttribute - attribute name
     * @param integer $primeryid - unique id used to make unique image name. Use dealer_id for this.
     * @param string  - image type (eg - profileimg, showroomlogo, usedcarimage), Use to decide folder name where image 
		    will be stored.
     */
    public static function uploadImages($model, $fileAttribute)
    {   
        $path = \Yii::$app->params['uploadPath'];

        //removing till upload path as uploads path differs
        $dbPath = str_replace(\Yii::getAlias('@app'), '', $path);

        if (!is_dir($path)) {
            $image_path = BaseFileHelper::createDirectory($path, 0777, true);
        }
        // $image = Image::getImagine();
		if(is_array($model->$fileAttribute))
		{
			
		    $imgArray = [];
		    foreach($model->$fileAttribute as $file)
		    {
			$imagename = md5($file->baseName . '_' . time());
			$file->saveAs($path .'/'. $imagename . '.' . $file->extension);
			array_push($imgArray,$dbPath . '/' . $imagename . '.' . $file->extension);
		    }
		    $model->$fileAttribute = $imgArray;
		}
		else
		{
		    $imagename = md5($model->$fileAttribute->baseName . '_' . time());
	        $imageSize = ($model->$fileAttribute->size)?(int)$model->$fileAttribute->size/1024:0;
	        
	    	$model->$fileAttribute->saveAs($path .'/'.$imagename . '.' . $model->$fileAttribute->extension);
	        // $newImage = $image->open($path .'/'.$imagename . '.' . $model->$fileAttribute->extension);
	        $model->$fileAttribute = $dbPath . '/' . $imagename . '.' . $model->$fileAttribute->extension;
	        // $model->width = $newImage->getSize()->getWidth();
	        // $model->height = $newImage->getSize()->getHeight();
		}
        return true;
    }
    /**
     * @uses Resize image on the basis of given width and height, Upload the new resized image on the server and return resized 
	    image URL to the calling file (view file).
     * @return string - resized image URL 
     * @param string $imagePath - original image path (without domain eg - showroomlogo/2016/05/11/e25900921e69a18f908a38eac52ae07c.jpg).
     * @param integer $newWidth - new width to be resize.
     * @param integer $newHeight - new height to be resize
     */
 //    public static function resizeRender($imagePath, $newWidth, $newHeight)
 //    {
	// if(!empty($imagePath))
	// {
	//     $fromPath = \Yii::$app->params['imageUrl'].$imagePath;
	//     $imagePathResize = preg_replace('/(\..+)/','_'.$newWidth.'X'.$newHeight.'$1', $imagePath);
	//     $filePath = \Yii::getAlias('@upload').$imagePath;
	//     if(file_exists($filePath))
	//     {
	// 	$toPath = Yii::getAlias('@upload').$imagePathResize;
	// 	if (!is_file($toPath)) 
	// 	{
	// 	    $crop = Image::getImagine()->open($fromPath)->resize(new Box($newWidth, $newHeight))->save($toPath, ['quality' => 100]);
	// 	}
	// 	return \Yii::$app->params['imageUrl'].$imagePathResize;	
	//     }
	//     return "http://placehold.it/".$newWidth."x".$newHeight;	
	// }
	// return '';
 //    }
    
 //    public static function resizeUpload($imageName, $newWidth, $newHeight, $folder)
 //    {
	// if(!empty($imageName))
	// {
	//     $fromPath = \Yii::$app->params['imageUrl'].'/usedcar/original/'.$imageName;
	//     $imagePathResize = $folder.'/'.$imageName;
	//     $filePath = \Yii::$app->params['uploadPath']['usedcar'].'original/'.$imageName;
	//     if(file_exists($filePath))
	//     {
	// 	$toPath = \Yii::$app->params['uploadPath']['usedcar'].$imagePathResize;
	// 	if (!is_file($toPath)) 
	// 	{
	// 	    $crop = Image::getImagine()->open($fromPath)->resize(new Box($newWidth, $newHeight))->save($toPath, ['quality' => 100]);
	// 	}
	// 	return $imageName;	
	//     }
	//     return '';	
	// }
	// return '';
 //    }
    
    public static function cropImage($image, $fromPath, $toPath)
    {
	$newImageName = '';
	$crop = Image::crop($fromPath.$image)->save($toPath.$newImageName, ['quality' => 80]);
    }
    
    public static function thumbnailImage($fromPath,$toPath)
    {
	$crop = Image::thumbnail($fromPath, 100, 100)->save($toPath, ['quality' => 100]);
    }
    /**
    * Resizing and Preserving Aspect Ratio
    */
    public static function resizeImage($image, $fromPath, $toPath, $newWidth, $newHeight)
    {
	$newImageName = '';
	$crop = Image::getImagine()->open($fromPath.$image)->thumbnail(new Box($newWidth, $newHeight))->save($toPath.$newImageName, ['quality' => 90]);
	return $crop;
    }

    public static function getValidImageExt()
    {
    	return array(
            'image/jpeg',
            'image/png',
            'image/jpg',
        );
    }
}
