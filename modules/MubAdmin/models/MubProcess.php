<?php 

namespace app\modules\MubAdmin\models;
use app\components\Model;
use app\helpers\HtmlHelper;

class MubProcess extends Model
{
	public $models = [];
    public $deps = [];
    public $relatedModels = [];
    
    public function getModels()
    {
        $this->models = [];
        return $this->models;
    }

    public function getFormData()
    {
        return [];
    }

    public function getRelatedModels($model)
    {
        $this->relatedModels = [];
        return $this->relatedModels;
    }

    public function saveData($data = [])
    {
        if (isset($data[])&&
            isset($data[]))
            {
            try {
            	$courseId = $this->saveCourse($data[]);
	                if ($courseId)
	                {
	                	$courseDetailId = $this->saveCourseDetail($data['courseDetail']);
                        if($courseDetailId)
                        {
                            return $courseId;    
                        }
                        else
                        {
                            p($data['courseDetail']->getErrors());
                        }
	                } 
	                else
	                {
	                    //TBD throw new exxception here to rollback
	                    p('data not saved');
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