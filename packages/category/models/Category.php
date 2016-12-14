<?php

namespace app\packages\category\models;

use vii\behaviors\NestedSetsBehavior;
use vii\behaviors\SluggableBehavior;
use vii\behaviors\SourceBehavior;

use vii\helpers\ArrayHelper;
use vii\helpers\DataHelper;
use vii\helpers\Html;
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

    public $entityTable;
    public $entityCache;
    public $entityRoute;
    public $entityId;
    public $entityKey;
    public $entityLanguage;
    public $entityApplication;

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
                ['class' => SourceBehavior::className(), 'attributeSync' => ['is_active', 'lft', 'rgt', 'depth']],
                ['class' => SluggableBehavior::className(), 'uniqueValidator' => []],
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(), [
                [['title', 'language', 'key'], 'required'],
                ['key', 'unique', 'targetAttribute' => ['language', 'key'], 'on' => 'root'],
            ]
        );
    }

    public function scenarios()
    {
        return ArrayHelper::merge(
            parent::scenarios(), [
                'root' => ['language', 'key', 'title', 'is_active'],
                'item' => ['language', 'key', 'title', 'slug', 'meta_title', 'meta_keyword', 'meta_description', 'classes', 'is_active'],
            ]
        );
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $this->triggerChange();
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $this->triggerChange();
    }

    public function triggerChange()
    {
        static::deleteAll(['language' => null]); // Fix MongoDB >= 3.2
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

    public function setTranslateValues($root, $language, $modelSource)
    {
        $this->attributes = $modelSource->attributes;
        $this->language = $language;
        $this->source_id = $modelSource->primaryKey;
        $this->root = $root;
        $this->lft = $modelSource->lft;
        $this->rgt = $modelSource->rgt;
        $this->depth = $modelSource->depth;
        $this->slug = null;
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

    public function getOptions($key = null, $parent = null, $language = null)
    {
        if ($key == null)
            $key = $this->entityKey;

        if ($language == null)
            $language = $this->entityLanguage;

        if ($language == null)
            $language = Yii::$app->language;

        $cacheKey = md5("category.Category.getOptions.{$this->entityCache}.{$language}.{$key}.{$parent}");
        $cacheData = Yii::$app->cache->get($cacheKey);
        if ($cacheData === false) {
            $query = static::find();
            $query->where(['language' => $language, 'key' => $key]);

            if ($parent != null) {
                $query->andWhere(['_id' => $parent]);
            } else {
                $query->andWhere(['lft' => 1]);
            }

            if (($model = $query->one()) === null) {
                return [];
            }

            if (($items = $model->children()->all()) === null) {
                return [];
            }

            $result = [];
            foreach ($items as $item) {
                $result[(string) $item->_id] = str_repeat('-- ', $item->depth - 1) . $item->title;
            }

            $cacheData = $result;
            //Yii::$app->cache->set($cacheKey, $cacheData, 86400);
        }

        return $cacheData;
    }

    public function getCategoriesText($categories = [])
    {
        if (empty($categories)) {
            return '';
        }

        if (is_string($categories) && ($model = Category::getData($categories)) != null) {
            return $model->title;
        }

        if (is_array($categories) && ($models = static::find()->where(['_id' => $categories])->all()) != null) {
            $html = '';
            foreach ($models as $model) {
                $html .= Html::tag('div', $model->title);
            }
            return $html;
        }

        return '';
    }
}
