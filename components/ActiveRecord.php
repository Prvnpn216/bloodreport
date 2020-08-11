<?php
namespace app\components;

/**
 * Base active record class for carbay models
 * @package common\components
 * 
 * @author Praveen Kumar <praveen@makeubig.com>
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * Get active query
     * @return ActiveQuery
     */
    public static function find()
    {
        return new ActiveQuery(get_called_class());
    }

    /**
     * Formats all model errors into a single string
     * @return string
     */
    public function formatErrors()
    {
        $result = '';
        foreach($this->getErrors() as $attribute => $errors) {
            $result .= implode(" ", $errors)." ";
        }
        return $result;
    }
}
