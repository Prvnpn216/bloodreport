<?php

namespace app\modules\MubAdmin\modules\users;

class User extends \app\modules\MubAdmin\MubAdmin
{
    public $controllerNamespace = 'app\modules\MubAdmin\modules\users\controllers';

    public $defaultRoute = 'user';
    
    public function init()
    {
        parent::init();
    }
}
