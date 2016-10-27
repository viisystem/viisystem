<?php

namespace app\packages\category\models;

use vii\behaviors\NestedSetsBehavior;
use vii\behaviors\SourceBehavior;

use vii\helpers\ArrayHelper;
use vii\helpers\DataHelper;
use vii\helpers\StringHelper;

use Yii;
use yii\mongodb\ActiveQuery;


class Category extends BaseCategory
{

    const OPERATION_MAKE_ROOT = 1;
    const OPERATION_PREPEND_TO = 2;
    const OPERATION_APPEND_TO = 3;
    const OPERATION_INSERT_BEFORE = 4;
    const OPERATION_INSERT_AFTER = 5;
    const OPERATION_DELETE_WITH_CHILDREN = 6;

    public static $operations = [
        self::OPERATION_PREPEND_TO => 'prependTo',
        self::OPERATION_APPEND_TO => 'appendTo',
        self::OPERATION_INSERT_BEFORE => 'insertBefore',
        self::OPERATION_INSERT_AFTER => 'insertAfter',
    ];

    public $items = [];

    public static $tableName = 'category';

    private static $_instance;

    /**
     * @return \app\packages\category\models\Category
     */
    public static function getInstance()
    {
        if (null === static::$_instance) {
            static::$_instance = new static();
        }

        return static::$_instance;
    }

    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    public static function findTable($tableName)
    {
        if ($tableName != null) {
            static::$tableName = $tableName;
        }

        return Yii::createObject(ActiveQuery::className(), [get_called_class()]);
    }

    public function setTableName($tableName = null)
    {
        if ($tableName != null) {
            static::$tableName = $tableName;
        }
    }

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(), [
                ['class' => NestedSetsBehavior::className()],
                ['class' => SourceBehavior::className(), 'attributeSync' => ['skin', 'is_active']],
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(), [
                [['title', 'language', 'lookup_id'], 'required'],
                ['lookup_id', 'unique', 'targetAttribute' => ['language', 'lookup_id'], 'on' => 'root'],
            ]
        );
    }

    public function scenarios()
    {
        return ArrayHelper::merge(
            parent::scenarios(), [
                'root' => ['language', 'lookup_id', 'title', 'is_active'],
                'item' => ['language', 'lookup_id', 'title', 'slug', 'meta_title', 'meta_keyword', 'meta_description', 'classes', 'is_active'],
            ]
        );
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        static::deleteAll(['lft' => 2, 'language' => null]);
    }

    public function getId()
    {
        return (string) $this->_id;
    }

    public function getLanguages()
    {
        return static::find()->select(['_id', 'language'])->where(['source_id' => $this->source_id])->indexBy('language')->asArray()->all();
    }

    public function setDefaultValues()
    {
        $this->language = Yii::$app->params['languageDefault'];
        $this->is_active = DataHelper::BOOLEAN_ON;
    }

    /**
     * @param $language string
     * @param $modelSource static
     */
    public function setTranslateValues($language, $modelSource)
    {
        $this->language = $language;
        $this->source_id = $modelSource->primaryKey;
        $this->lookup_id = $modelSource->lookup_id;
        $this->title = $modelSource->title;
    }

    public function getData($id)
    {
        $id = StringHelper::getId($id);
        $cacheKey = "category.Category.getData.{$id}";
        $cacheData = Yii::$app->cache->get($cacheKey);
        if ($cacheData === false) {
            $cacheData = static::findOne($id);
            //Yii::$app->cache->set($cacheKey, $cacheData, 86400, CacheHelper::getFileDependency('category'));
        }

        return $cacheData;
    }

}
