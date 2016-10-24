<?php

namespace app\packages\category\models;

use Yii;

/**
 * This is the model class for collection "category".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $root
 * @property mixed $lft
 * @property mixed $rgt
 * @property mixed $depth
 * @property mixed $title
 * @property mixed $title_extra
 * @property mixed $slug
 * @property mixed $image
 * @property mixed $classes
 * @property mixed $skin
 * @property mixed $description
 * @property mixed $content
 * @property mixed $meta_title
 * @property mixed $meta_keyword
 * @property mixed $meta_description
 * @property mixed $is_active
 * @property mixed $is_promotion
 * @property mixed $language
 * @property mixed $lookup_id
 * @property mixed $source_id
 */
class BaseCategory extends \vii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'root',
            'lft',
            'rgt',
            'depth',
            'title',
            'title_extra',
            'slug',
            'image',
            'classes',
            'skin',
            'description',
            'content',
            'meta_title',
            'meta_keyword',
            'meta_description',
            'is_active',
            'is_promotion',
            'language',
            'lookup_id',
            'source_id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['root', 'lft', 'rgt', 'depth', 'title', 'title_extra', 'slug', 'image', 'classes', 'skin', 'description', 'content', 'meta_title', 'meta_keyword', 'meta_description', 'is_active', 'is_promotion', 'language', 'lookup_id', 'source_id'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => Yii::t('category', 'ID'),
            'root' => Yii::t('category', 'Root'),
            'lft' => Yii::t('category', 'Lft'),
            'rgt' => Yii::t('category', 'Rgt'),
            'depth' => Yii::t('category', 'Depth'),
            'title' => Yii::t('category', 'Title'),
            'title_extra' => Yii::t('category', 'Title Extra'),
            'slug' => Yii::t('category', 'Slug'),
            'image' => Yii::t('category', 'Image'),
            'classes' => Yii::t('category', 'Classes'),
            'skin' => Yii::t('category', 'Skin'),
            'description' => Yii::t('category', 'Description'),
            'content' => Yii::t('category', 'Content'),
            'meta_title' => Yii::t('category', 'Meta Title'),
            'meta_keyword' => Yii::t('category', 'Meta Keyword'),
            'meta_description' => Yii::t('category', 'Meta Description'),
            'is_active' => Yii::t('category', 'Is Active'),
            'is_promotion' => Yii::t('category', 'Is Promotion'),
            'language' => Yii::t('category', 'Language'),
            'lookup_id' => Yii::t('category', 'Lookup ID'),
            'source_id' => Yii::t('category', 'Source ID'),
        ];
    }
}
