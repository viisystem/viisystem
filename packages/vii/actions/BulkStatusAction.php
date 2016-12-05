<?php
namespace vii\actions;

use Yii;
use yii\base\Action;


class BulkStatusAction extends Action
{
    public $modelClass;
    public $statusField = 'status';
    public $statusValue = 10;

    public function run()
    {
        Yii::$app->response->format = 'json';
        
        $keys = Yii::$app->request->getBodyParam('keys');
        if (!is_array($keys) || empty($keys)) {
            return ['s' => 0];
        }

        $obj = Yii::createObject($this->modelClass);
        $query = $obj::find()->where(['in', '_id', $keys]);
        if ($query->hasMethod('access')) {
            $query->access();
        }

        if (($models = $query->all()) === null) {
            return ['s' => 0];
        }

//        $ids = ArrayHelper::getColumn($model, '_id');
//        $exec = $obj::updateAll([$this->statusField => $this->statusValue], ['in', '_id', $ids]);

        $exec = 0;
        foreach ($models as $model) {
            $model->{$this->statusField} = $this->statusValue;
            if ($model->save()) {
                $exec++;
            }
        }

        return [
            's' => 1,
            'e' => $exec
        ];
    }
}
