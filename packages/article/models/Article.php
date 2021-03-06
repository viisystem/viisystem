<?php

namespace app\packages\article\models;

use Yii;

use vii\behaviors\SluggableBehavior;
use vii\behaviors\SourceBehavior;
use vii\behaviors\SortBehavior;
use vii\behaviors\UploadBehavior;


use vii\helpers\ArrayHelper;

use app\packages\category\models\Category;


class Article extends BaseArticle
{
    public $moduleName = 'article';
    public $image_form;
    public $image_temp;

    public $lookupCategory = 'article';

    private $_objCategory = [];

    private static $_instance = null;

    /**
     * @return \app\packages\article\models\Article
     */
    public static function getInstance()
    {
        if (null === static::$_instance) {
            static::$_instance = new static();
        }

        return static::$_instance;
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes){
        Yii::$app->cache->delete('articles_list');
        Yii::$app->cache->delete('articles_listpromotion');
        Yii::$app->cache->delete('articles_listnews');
        Yii::$app->cache->delete('article_info_' . $this->_id);
        Yii::$app->cache->delete('articles_feature_' . $this->_id . 'category');
        Yii::$app->cache->delete('articles_feature_' . $this->_id . 'tags');
        Yii::$app->cache->delete('articles_feature_' . $this->_id);

        return parent::afterSave($insert, $changedAttributes);
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            ['class' => SluggableBehavior::className(), 'attribute' => 'title', 'uniqueValidator' => ['targetAttribute' => ['language', 'slug']]],
            ['class' => SourceBehavior::className(), 'attributeSync' => ['image', 'sort', 'is_promotion', 'status']],
            ['class' => SortBehavior::className()],
            ['class' => UploadBehavior::className(), 'attribute' => 'image', 'uploadAttribute' => 'image_form', 'uploadTempAttribute' => 'image_temp'],
        ]);
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(), [
                [['title'], 'required'],
                ['image_form', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 5*1024*1024],
                ['image_form', 'image', 'extensions' => ['png', 'jpg', 'gif'], 'minWidth' => 100, 'maxWidth' => 2048, 'minHeight' => 100, 'maxHeight' => 2048],
            ]
        );
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'image_form' => Yii::t('article', 'Image Form')
        ]);
    }

    public function setDefaultValues()
    {
        $this->language = Yii::$app->params['languageDefault'];

        $this->is_promotion = '0';
        $this->status = '1';
    }

    /**
     * @param $language string
     * @param $modelSource \app\packages\blog\models\Blog
     */
    public function setTranslateValues($language, $modelSource)
    {
        $this->language = $language;
        $this->source_id = $modelSource->primaryKey;
        $this->title = $modelSource->title;
    }

    public function getLanguages()
    {
        return static::find()->select(['_id', 'language'])->where(['source_id' => $this->source_id])->indexBy('language')->asArray()->all();
    }

    public function getCreatedBy(){
        $model = \app\packages\account\models\User::findOne($this->created_by);

        if (empty($model))
            return null;

        return ArrayHelper::getValue($model->name, 'first') . ' ' . ArrayHelper::getValue($model->name, 'middle') . ' ' . ArrayHelper::getValue($model->name, 'last');
    }

    /**
     * @param null $key
     * @param null $language
     * @return Category
     */
    public function getCategory($key = null, $language = null) {
        if ($key === null)
            $key = $this->lookupCategory;

        if ($language == null)
            $language = $this->language;

        if ($language == null)
            $language = Yii::$app->language;

        if (!isset($this->_objCategory[$key])) {
            $this->_objCategory[$key] = new Category();
            $this->_objCategory[$key]->entityTable = $this->collectionName();
            $this->_objCategory[$key]->entityCache = "article.Article.{$key}.{$language}.{$this->primaryKey}";
            $this->_objCategory[$key]->entityRoute = '/article/article/category';
            $this->_objCategory[$key]->entityId = $this->primaryKey;
            $this->_objCategory[$key]->entityKey = $key;
            $this->_objCategory[$key]->entityLanguage = $language;
            $this->_objCategory[$key]->entityApplication = Yii::$app->id;
        }

        return $this->_objCategory[$key];
    }

}
