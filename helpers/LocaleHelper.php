<?php

namespace common\helpers;

use Yii;
/**
* @use This helpers class is used to return languages used in specific country.
*
* @auther Sujit Verma <sujit.verma@girnarsoft.com>
*/
class LocaleHelper
{
    public static function getLanguages()
    {
	$currentModule = Yii::$app->getModules()[Yii::getAlias('@country')];
	$module = new $currentModule(Yii::getAlias('@country'));
	if(empty($module))
	{
            $module = current(Yii::$app->getModules());
	}
	$languages = !empty($module->languages) ? (is_string($module->languages) ? [$module->languages] : $module->languages) : [];
	return $languages;
    }

    public function getLocaleFields($fields = []){
    	$allFields = \Yii\helpers\ArrayHelper::toArray($fields);
    	$lang = \Yii::$app->language;
    	$localeFields = [];
    	$modLang = array_keys(self::getLanguages());
    	$diff = array_diff($modLang,[$lang]);
    	$regex = "/(\w)*[_](" . implode('|', $diff) . ")/";
    	foreach ($allFields as $i => $field) {
    		$fields = preg_grep($regex,array_keys($field));
    		foreach ($fields as $key => $fieldName) {
    			unset($allFields[$i][$fieldName]);
    		}
    	}
    	return $allFields;
    }
    
    public static function translatedFields($field)
    {
	$languages = LocaleHelper::getLanguages();
        $transFields = [];
	foreach ($languages as $lang => $langName) 
	{
	    $transFields[$langName]= $field.'_'.$lang;
	}
        return $transFields;
    }
    
    public static function valueTranslatedFields($field)
    {
	return array_values(LocaleHelper::translatedFields($field));
    }
    
    public static function translate($field, $model = [], $lang=null)
    {
	$cookies = Yii::$app->request->cookies;
        if($lang)
        {
            $languages = array_keys(static::getLanguages());
            if(!in_array($lang, $languages))
            {
                return false;
            }
        }
        else
        {
            $lang = ($cookies->has('language'))?$cookies->getValue('language'):'en';
        }
	$field = $field.'_'.$lang;
        if(empty($model))
        {
            return $field;
        }
	return $model->$field;
    }
}