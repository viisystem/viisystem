<?php

namespace app\packages\dashboard\widgets;

use yii\base\Widget;
use vii\helpers\ArrayHelper;
use Yii;

class Search extends Widget{

    public $_params = [];

    public function init(){
        parent::init();
    }

    public function run(){
    	$view = ArrayHelper::getValue($this->_params, 'view', 'search');
        return $this->render($view);
    }

}