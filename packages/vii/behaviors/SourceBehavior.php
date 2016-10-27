<?php

namespace vii\behaviors;

use Yii;

use yii\base\Behavior;
use yii\mongodb\ActiveRecord;


class SourceBehavior extends Behavior
{

    public $attribute = 'source_id';
    public $attributeSync = [];

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
        ];

    }

    public function afterSave()
    {
        $owner = $this->owner;

        if ($owner->{$this->attribute} == null) {
            $owner::updateAll([$this->attribute => $owner->primaryKey], ['_id' => $owner->primaryKey]);
        }

        if (empty($this->attributeSync)) {
            return true;
        }

        $owner->refresh();
        $attributeUpdate = [];
        foreach ($this->attributeSync as $attr) {
            $attributeUpdate[$attr] = $owner->$attr;
        }

        $owner::updateAll($attributeUpdate, [$this->attribute => $owner->{$this->attribute}]);
    }

    public function afterDelete()
    {
        $owner = $this->owner;
        $models = $owner::find()->where([$this->attribute => $owner->primaryKey])->all();

        if ($models == null) {
            return true;
        }

        foreach ($models as $model) {
            $model->delete();
        }

        return true;
    }

}