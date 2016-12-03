<?php
namespace vii\actions;

use Yii;
use yii\base\Action;


class BulkDeleteAction extends Action
{
    public $modelClass;

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

        // $ids = ArrayHelper::getColumn($models, '_id');
        // $exec = $obj::deleteAll(['in', '_id', $ids]);

        $exec = 0;
        foreach ($models as $model) {
            if ($model->delete()) {
                $exec++;
            }
        }

        return [
            's' => 1,
            'e' => $exec
        ];
    }
}
