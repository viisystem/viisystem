<?php
namespace vii\actions;

use Yii;
use yii\base\Action;

use vii\helpers\DataHelper;
use vii\helpers\StringHelper;

class BooleanAction extends Action
{
    public $modelClass;
    public $statusField = 'is_approved';

    public function run($id)
    {
        Yii::$app->response->format = 'json';

        $obj = Yii::createObject($this->modelClass);
        $query = $obj::find()->where(['_id' => StringHelper::getId($id)]);

        if ($query->hasMethod('access')) {
            $query->access();
        }

        if (($model = $query->one()) === null) {
            return ['s' => 0, 'm' => Yii::t('common', 'The requested page does not exist.')];
        }

        $model->{$this->statusField} = ($model->{$this->statusField} == DataHelper::BOOLEAN_ON)
            ? DataHelper::BOOLEAN_OFF
            : DataHelper::BOOLEAN_ON;

        return [
            's' => ($model->save()) ? 1 : 0
        ];
    }
}
