<?php
namespace viisystem\common\controllers\frontend;

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
        echo 'Test'; die;
        return $this->render('index');
    }
}
