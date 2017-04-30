<?php

namespace vii\components;

//use MongoDate;
use MongoDB\BSON\UTCDateTime;
use Yii;
use yii\helpers\Url;
use vii\helpers\ClientHelper;
use vii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use vii\helpers\FileHelper;

class ActiveRecord extends \yii\mongodb\ActiveRecord {

    public $url;
    public $image_old;

    /**
     * @inheritdoc
     */
    public function beforeSave($insert) {
        $attributes = array_keys($this->getAttributes());

        // ID
        if ($this->isNewRecord AND empty($this->_id))
            $this->_id = uniqid();

        // Code
        if ($this->isNewRecord AND in_array('code', $attributes) AND empty($this->code))
            $this->code = mt_rand(0, 99999999);
        
        // SEO
        if (in_array('title', $attributes) AND in_array('seo_url', $attributes) AND empty($this->seo_url))
            $this->seo_url = StringHelper::asUrl($this->title);
        if (in_array('title', $attributes) AND in_array('seo_title', $attributes) AND empty($this->seo_title))
            $this->seo_title = $this->title;
        if (in_array('description', $attributes) AND in_array('seo_desc', $attributes) AND empty($this->seo_desc))
            $this->seo_desc = $this->description;
        
        // Upload image
        if (in_array('image', $attributes)) {
            $image = \yii\web\UploadedFile::getInstance($this, 'image');
            if (!empty($image)) {
                $this->image = \yii\web\UploadedFile::getInstance($this, 'image');
                $ext = FileHelper::getExtention($this->image);
                if (!empty($ext)) {
                    $fileDir = Yii::$app->controller->module->id . '/' . date('Y/m/d/');
                    if (property_exists($this, 'title'))
                        $title = $this->title;
                    elseif (property_exists($this, 'name'))
                        $title = $this->name;
                    else
                        $title = uniqid();
                    $fileName = StringHelper::asUrl($title) . '.' . $ext;
                    $folder = Yii::$app->params['uploadPath'] . '/' . Yii::$app->params['uploadDir'] . '/' . $fileDir;
                    FileHelper::createDirectory($folder);
                    $this->image->saveAs($folder . $fileName);
                    $this->image = $fileDir . $fileName;
                }
            } elseif (!empty($this->image_old)) {
                $this->image = $this->image_old;
            }
        }

        if (in_array('gallery', $attributes) && empty($this->gallery)) {
            $this->gallery = $this->getOldAttribute('gallery');
        }

        // creator, editor and time
        //$now = new MongoDate();
        $now = new UTCDateTime(round(microtime(true) * 1000));
        if (in_array('updated_at', $attributes) AND empty($this->updated_at))
            $this->updated_at = $now;
        if (in_array('editor', $attributes) AND ! ClientHelper::isCommandLine())
            $this->editor = Yii::$app->user->id;
        if ($this->isNewRecord) {
            if (in_array('created_by', $attributes) AND ! ClientHelper::isCommandLine())
                $this->created_by = Yii::$app->user->id;
            if (in_array('created_at', $attributes) AND $this->created_at == null)
                $this->created_at = $now;
        }

        // Cache
        Yii::$app->cache->flush();

        return parent::beforeSave($insert);
    }

    public function afterFind() {
        $attributes = array_keys($this->getAttributes());
        if (in_array('image', $attributes)) {
            $this->image_old = $this->image;
        }

        $this->generationUrl();

        parent::afterFind();
    }

    public function afterDelete()
    {
        parent::afterDelete();
        Yii::$app->cache->flush();
    }

    public function generationUrl($id = NULL, $title = NULL) {
        $attributes = array_keys($this->getAttributes());

        $routes = ["/{$this->moduleName}/frontend/detail/index"];

        if (!empty($this->slug)) {
            if (is_array($this->slug)) {
                $routes['slugprefix'] = implode('/', $this->slug);
            } else {
                $routes['slugprefix'] = $this->slug;
            }
        } else if (isset($this->category) && is_array($this->category)) {
            $category = \app\packages\category\models\Category::findOne($this->category[0]);
            if ($category != null && $category->slug != null) {
                $routes['slugprefix'] = $category->slug;
            }
        }

        $slug = '';
        if (!empty($title)) {
            $slug = $title;
        } elseif (!empty($this->slug)) {
            $slug = $this->slug;
        } elseif (in_array('seo_title', $attributes) AND !empty($this->seo_title)) {
            $slug = $this->seo_title;
        } elseif (in_array('title', $attributes) AND !empty($this->title)) {
            $slug = $this->title;
        } elseif (in_array('name', $attributes) AND !empty($this->name)) {
            $slug = $this->name;
        }

        $routes['slug'] = StringHelper::asUrl($slug);

        return $this->url = Url::to($routes);
    }

}
