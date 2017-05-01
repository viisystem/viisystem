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

    	$is_borrow = Yii::$app->request->post('is_borrow');

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

    	$model = $this->builData($is_borrow);

        // List bank chart
        $arrBankChart = [];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $cookies = Yii::$app->response->cookies;
            $cookies->remove('services_form');
            // add a new cookie to the response to be sent
            $cookies->add(new \yii\web\Cookie([
                'name' => 'services_form',
                'value' => $model->attributes,
            ]));

            $arrBankChart = $this->generateArrBankChart($model, $index_type);
        }

        Yii::$app->view->title = 'Dịch vụ ' . strtolower($serviceName);

    	return $this->render('index', ['serviceName' => $serviceName, 'banks' => $banks, 'model' => $model, 'arrBankChart' => $arrBankChart]);
    }

    private function generateArrBankChart($model, $index_type) {
        $arrBankChart = [];
        $banks_chart = $this->getBankServicesQuery($index_type)->all();
        foreach ($banks_chart as $item) {
            $borrow_money = round($model->borrow_money * (($item->rate / 100) / $model->borrow_time));
            $current_price = round($model->borrow_money / $model->borrow_time);

            $arrBankChart['rate_special'][$item->bank] = $item->rate_special;
            $arrBankChart['rate'][$item->bank] = $item->rate;
            $arrBankChart['borrow_money'][$item->bank] = $borrow_money;
            $arrBankChart['current_price'][$item->bank] = $current_price;
            $arrBankChart['current_borrow'][$item->bank] = $borrow_money + $current_price;
        }

        return $arrBankChart;
    }

    private function builData($is_borrow = null) {
        $model = new ServicesForm;
        if (empty($is_borrow))
            $model->scenario = 'borrow';

        $cookies = Yii::$app->request->cookies;
        // get the cookie value
        $services_form = $cookies->getValue('services_form');

        if (!Yii::$app->user->isGuest) {
            $fullname = ArrayHelper::getValue(Yii::$app->user->identity->name, 'first') . " " . ArrayHelper::getValue(Yii::$app->user->identity->name, 'middle') . " " . ArrayHelper::getValue(Yii::$app->user->identity->name, 'last');
            $model->fullname = $fullname;
            $model->email = Yii::$app->user->identity->displayEmails;
            $model->phone = ArrayHelper::getValue(Yii::$app->user->identity->phone, 'mobile');
        }

        if ($services_form) {
            foreach ($services_form as $attribute => $value) {
                if ($attribute == '_id')
                    continue;
                
                $model->$attribute = $value;
            }
        }
        return $model;
    }

    public function actionDetail() {
        $bank = Yii::$app->request->get('bank');
        $rate = Yii::$app->request->get('rate');
        $rate_special = Yii::$app->request->get('rate_special');
        $money = Yii::$app->request->get('money');
        $time = Yii::$app->request->get('time');

        Yii::$app->view->title = 'Bảng chi tiết lịch trả nợ ngân hàng ' . $bank . ' với dư nợ giảm dần';

        return $this->render('detail', ['bank' => $bank, 'rate' => $rate, 'rate_special' => $rate_special, 'money' => $money, 'time' => $time]);
    }

    private function getBankServices($index_type){
       $query = $this->getBankServicesQuery($index_type);

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        return $dataProvider;
    }

    private function getBankServicesQuery($index_type){
        $query = Services::find();

        $condition = ['type' => $index_type, 'status' => '1'];

        $query->where($condition);
        $query->orderBy('_id DESC');

        return $query;
    }
}
