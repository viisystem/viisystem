<?php

namespace vii\behaviors;

use Yii;

use yii\base\Behavior;
use yii\mongodb\ActiveRecord;


class SortBehavior extends Behavior
{

    public $attribute = 'sort';

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
        ];
    }

    public function beforeSave()
    {
        $owner = $this->owner;
        $value = (int) $owner->{$this->attribute};

        if ($value == 0) {
            $value = (int) $this->owner->find()->max($this->attribute) + 1;
        }

        $owner->{$this->attribute} = $value;
    }

}