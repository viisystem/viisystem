<?php
namespace viisystem\common\controllers\backend;

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
}
