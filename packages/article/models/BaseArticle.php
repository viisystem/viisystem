<?php

namespace app\packages\article\models;

use Yii;

/**
 * This is the model class for collection "article".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $title
 * @property mixed $slug
 * @property mixed $image
 * @property mixed $category
 * @property mixed $excerpt
 * @property mixed $content
 * @property mixed $meta_title
 * @property mixed $meta_keyword
 * @property mixed $meta_description
 * @property mixed $tags
 * @property mixed $skin
 * @property mixed $sort
 * @property mixed $is_promotion
 * @property mixed $status
 * @property mixed $created_at
 * @property mixed $created_by
 * @property mixed $updated_at
 * @property mixed $updated_by
 * @property mixed $language
 * @property mixed $source_id
 */
class BaseArticle extends \vii\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'title',
            'slug',
            'image',
            'category',
            'excerpt',
            'content',
            'meta_title',
            'meta_keyword',
            'meta_description',
            'tags',
            'skin',
            'sort',
            'is_promotion',
            'status',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'language',
            'source_id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'image', 'category', 'excerpt', 'content', 'meta_title', 'meta_keyword', 'meta_description', 'tags', 'skin', 'sort', 'is_promotion', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'language', 'source_id'], 'safe']        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => Yii::t('article', 'ID'),
            'title' => Yii::t('article', 'Title'),
            'slug' => Yii::t('article', 'Slug'),
            'image' => Yii::t('article', 'Image'),
            'category' => Yii::t('article', 'Category'),
            'excerpt' => Yii::t('article', 'Excerpt'),
            'content' => Yii::t('article', 'Content'),
            'meta_title' => Yii::t('article', 'Meta Title'),
            'meta_keyword' => Yii::t('article', 'Meta Keyword'),
            'meta_description' => Yii::t('article', 'Meta Description'),
            'tags' => Yii::t('article', 'Tags'),
            'skin' => Yii::t('article', 'Skin'),
            'sort' => Yii::t('article', 'Sort'),
            'is_promotion' => Yii::t('article', 'Is Promotion'),
            'status' => Yii::t('article', 'Status'),
            'created_at' => Yii::t('article', 'Created At'),
            'created_by' => Yii::t('article', 'Created By'),
            'updated_at' => Yii::t('article', 'Updated At'),
            'updated_by' => Yii::t('article', 'Updated By'),
            'language' => Yii::t('article', 'Language'),
            'source_id' => Yii::t('article', 'Source ID'),
        ];
    }
}
