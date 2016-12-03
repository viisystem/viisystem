<?php

namespace app\packages\blog\models;

use Yii;

/**
 * This is the model class for collection "blog".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $title
 * @property mixed $slug
 * @property mixed $image
 * @property mixed $category
 * @property mixed $excerpt
 * @property mixed $content
 * @property mixed $seo_title
 * @property mixed $seo_keyword
 * @property mixed $seo_description
 * @property mixed $tags
 * @property mixed $skin
 * @property mixed $sort
 * @property mixed $is_promotion
 * @property mixed $is_active
 * @property mixed $created_at
 * @property mixed $created_by
 * @property mixed $updated_at
 * @property mixed $updated_by
 * @property mixed $language
 * @property mixed $source_id
 */
class BaseBlog extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'blog';
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
            'seo_title',
            'seo_keyword',
            'seo_description',
            'tags',
            'skin',
            'sort',
            'is_promotion',
            'is_active',
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
            [['title', 'slug', 'image', 'category', 'excerpt', 'content', 'seo_title', 'seo_keyword', 'seo_description', 'tags', 'skin', 'sort', 'is_promotion', 'is_active', 'created_at', 'created_by', 'updated_at', 'updated_by', 'language', 'source_id'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => Yii::t('blog', 'ID'),
            'title' => Yii::t('blog', 'Title'),
            'slug' => Yii::t('blog', 'Slug'),
            'image' => Yii::t('blog', 'Image'),
            'category' => Yii::t('blog', 'Category'),
            'excerpt' => Yii::t('blog', 'Excerpt'),
            'content' => Yii::t('blog', 'Content'),
            'seo_title' => Yii::t('blog', 'Seo Title'),
            'seo_keyword' => Yii::t('blog', 'Seo Keyword'),
            'seo_description' => Yii::t('blog', 'Seo Description'),
            'tags' => Yii::t('blog', 'Tags'),
            'skin' => Yii::t('blog', 'Skin'),
            'sort' => Yii::t('blog', 'Sort'),
            'is_promotion' => Yii::t('blog', 'Is Promotion'),
            'is_active' => Yii::t('blog', 'Is Active'),
            'created_at' => Yii::t('blog', 'Created At'),
            'created_by' => Yii::t('blog', 'Created By'),
            'updated_at' => Yii::t('blog', 'Updated At'),
            'updated_by' => Yii::t('blog', 'Updated By'),
            'language' => Yii::t('blog', 'Language'),
            'source_id' => Yii::t('blog', 'Source ID'),
        ];
    }
}
