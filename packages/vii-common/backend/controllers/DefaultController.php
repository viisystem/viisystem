<?php
namespace viisystem\common\backend\controllers;

use Yii;
use yii\web\Controller;


/**
 * Default controller
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTest()
    {
        echo 'TEST';
    }
}
