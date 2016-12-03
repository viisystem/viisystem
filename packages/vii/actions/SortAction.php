<?php
namespace jurakit\actions;

use vii\helpers\ArrayHelper;
use vii\helpers\StringHelper;

use Yii;
use yii\base\Action;

class SortAction extends Action
{
    public $modelClass;
    public $orderAttribute = 'sort';

    public function run()
    {
        Yii::$app->response->format = 'json';

        $data = Yii::$app->request->post('params');
        $dataTemp = $data;
        ArrayHelper::multisort($dataTemp, 'ordering', SORT_DESC);

        $dataOrdering = [];
        foreach ($dataTemp as $index => $item) {
            $dataOrdering[$index] = (int) $item['ordering'];
        }

        $exec = 0;
        $obj = Yii::createObject($this->modelClass);
        foreach ($data as $index => $item) {
            $id = StringHelper::getId($item['key']);
            $ordering = $dataOrdering[$index];

            if (($model = $obj::find()->andWhere(['_id' => $id])->one()) !== null) {
                $model->{$this->orderAttribute} = ($ordering > 0) ? $ordering : 0;
                if ($model->update(false, [$this->orderAttribute])) {
                    $exec++;
                }
            }
        }

        return ['s' => ($exec > 0) ? 1 : 0];
    }
}
