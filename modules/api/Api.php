<?php

namespace app\modules\api;

/**
 * api module definition class
 */
class Api extends \app\components\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\api\controllers';
    public $defaultRoute = 'dashboard';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}
