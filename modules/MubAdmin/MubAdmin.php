<?php

namespace app\modules\MubAdmin;

class MubAdmin extends \app\components\Module
{
    public $controllerNamespace = 'app\modules\MubAdmin\controllers';
    public $defaultRoute = 'dashboard';
    public function init()
    {
        parent::init();

        $this->modules = [
        'users' => [
            'class' => 'app\modules\MubAdmin\modules\users\User',
            ]
        ];
    }
}
