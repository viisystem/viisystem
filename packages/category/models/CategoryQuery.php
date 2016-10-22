<?php

namespace app\packages\category\models;

use vii\behaviors\NestedSetsQueryBehavior;
use yii\mongodb\ActiveQuery;


class CategoryQuery extends ActiveQuery
{
    public function behaviors()
    {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
}
