<?php
namespace app\modules\MubAdmin\modules\users\models;
use app\components\Model;
use app\helpers\HtmlHelper;
use app\models\MubUser;
use app\models\MubCategory;
use app\models\PatientReport;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use app\helpers\ImageUploader;
use app\helpers\FileUploader;
use app\models\ResourcesSearch;

class ReportProcess extends Model
{
    public $models = [];
    public $deps = [];
    public $relatedModels = [];
    
    public function getModels()
    {
        $patientReport = new PatientReport(); 
        $this->models = [
            'report' => $patientReport
        ];
        return $this->models;
    }

    public function getFormData()
    {
        return [];
    }

    public function getRelatedModels($model)
    {
        $patientReport = $model;
        $this->relatedModels = [
            'report' => $patientReport
        ];
        return $this->relatedModels;
    }

    public function uploadReportFile($file){
    	$uploadedResource = UploadedFile::getInstance($resource, 'url');
    	if(\Yii::$app->controller->action->id === 'create'){
    		if(empty($uploadedResource)){
    			throw new \yii\web\HttpException(500, 'Resource file not uploded');
    			return false;
    		}
    		else
    		{
    			$fileUploader = new FileUploader();
    			$resource->url = $uploadedResource;
            	$uploadedImage = $fileUploader->uploadFile($resource,'url');
    		}
    	}
    	elseif(\Yii::$app->controller->action->id === 'update'){
    		if(empty($uploadedResource))
			{
				$resource->url = PatientReport::findOne($resource->id)->url;
			}
			else
			{
				$fileUploader = new FileUploader();
    			$resource->url = $uploadedResource;
            	$uploadedImage = $fileUploader->uploadFile($resource,'url');
			}
    	}
    	return $resource;
    }

    public function checkResourcePrice($resource){
    	if($resource->free === 'free'){
    		$resource->price = 0.00;
    	}
    	else
    	{
    		if(!$resource->price || $resource->price == 0){
    			$resource->addError('price','Price can not be null for commercial resource');
    		}
    	}
    	return $resource;
    }

    public function saveResource($resource){
		$resource = $this->setResourceThumbnail($resource);
    	if($resource->type == 'link'){
	    	$resource->embed = HtmlHelper::getEmbedLink($resource->url);
	   	}
    	elseif($resource->type == 'file')
    	{
    		$resource = $this->uploadResourceFile($resource);
    	}
    	if($resource->free === '')
    	{
    		$resource->free = 'free';
    	}
    	$resource = $this->checkResourcePrice($resource);
    	if(!$resource->save()){
    		p($resource->getErrors());
    	}
    	return $resource->id;
    }

    public function saveData($data)
    {
    	if (isset($data['report']))
        {
        try {
                $reportId = $this->saveReport($data['report']);
                if ($reportId)
                {
                    return $reportId;    
                } 
                else
                {
                    throw new \yii\web\HttpException(500, 'Resources data not saved');
                } 
            }
            catch (\Exception $e)
            {
                throw $e;
            }
        } 
        else
        {
            throw new \yii\web\HttpException(500, 'Model Not Loaded properly');
        }
    }
}