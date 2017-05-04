<?php

namespace app\packages\services\widgets;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use app\packages\services\models\ServicesForm;
use Yii;

class Services extends Widget{

    public $_params = [];

    public function init(){
        parent::init();
    }

    public function run(){
    	$view = ArrayHelper::getValue($this->_params, 'view', 'services');
    	$slug = ArrayHelper::getValue($this->_params, 'slug', null);

    	$model = new ServicesForm;
        if ('the-tin-dung' == $slug)
            $model->scenario = 'borrow_salary';
        else
            $model->scenario = 'borrow';
        return $this->render($view, ['model' => $model, 'slug' => $slug]);
    }

}