<?php

namespace app\packages\banner\models;

use Yii;
use DateTime;
use vii\behaviors\SluggableBehavior;
use vii\behaviors\SourceBehavior;
use vii\behaviors\SortBehavior;
use vii\behaviors\UploadBehavior;
use vii\helpers\ArrayHelper;


class Banner extends BannerBase
{

    public $moduleName = 'banner';

    public $image_form;
    public $image_temp;

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            ['class' => SortBehavior::className()],
            ['class' => UploadBehavior::className(), 'attribute' => 'image', 'uploadAttribute' => 'image_form', 'uploadTempAttribute' => 'image_temp'],
        ]);
    }

    /**
     * @return \app\packages\contact\models\Contact
     */
    public static function getInstance()
    {
        if (null === static::$_instance) {
            static::$_instance = new static();
        }

        return static::$_instance;
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'default' => ['title', 'link', 'target', 'image', 'started_date', 'sort', 'ended_date', 'created_at', 'created_by', 'updated_at', 'language', 'status'],
        ];
    }

    public function setDefaultValues()
    {
        $this->language = Yii::$app->params['languageDefault'];

        $this->target = '1';
        $this->status = '1';
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes){
        Yii::$app->cache->delete('banner_list');

        return parent::afterSave($insert, $changedAttributes);
    }

}
