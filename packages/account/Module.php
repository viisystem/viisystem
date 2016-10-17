<?php

namespace app\packages\account;
use yii\filters\AccessControl;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\packages\account\controllers';

    public function init()
    {
        parent::init();

    }
}