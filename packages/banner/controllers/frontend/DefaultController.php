<?php

namespace app\packages\services\controllers\frontend;

use yii\web\Controller;
use app\packages\services\models\Services;
use app\packages\services\models\ServicesForm;
use vii\helpers\ArrayHelper;
use Yii;

class DefaultController extends Controller
{
    public function actionIndex() {
    	$slug = Yii::$app->request->get('slug');

    	// Get service by slug
    	$arrRewrite = [
    		'vay-mua-nha' => Services::TYPE_HOUSE,
    		'vay-mua-o-to' => Services::TYPE_CAR,
    		'vay-tin-chap-tieu-dung' => Services::TYPE_CONSUMER_CREDIT,
    		'the-tin-dung' => Services::TYPE_CREDIT_CARD,
    	];

    	$index_type = ArrayHelper::getValue($arrRewrite, $slug);
    	$serviceName = ArrayHelper::getValue(Services::getInstance()->arrType, $index_type);

    	// List bank for service
    	$banks = $this->getBankServices($index_type);

    	$model = new ServicesForm;
    	$model->load(Yii::$app->request->post());

    	return $this->render('index', ['serviceName' => $serviceName, 'banks' => $banks, 'model' => $model]);
    }

    private function getBankServices($index_type){
        $query = Services::find();

        $condition = ['type' => $index_type, 'status' => '1'];

        $query->where($condition);
        $query->orderBy('_id DESC');

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        return $dataProvider;
    }
}
