<?php

namespace app\packages\account\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

class Login extends Widget
{
    public $model;

    public function run()
    {
        return $this->render('login', [
			'model' => $this->model,
		]);
    }
}