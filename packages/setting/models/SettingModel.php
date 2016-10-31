<?php

namespace app\packages\setting\models;

use vii\helpers\FileHelper;

use yii\base\DynamicModel;
use yii\web\UploadedFile;
use Yii;


class SettingModel extends DynamicModel
{

    public $oldAttributes = [];
    public $model = null;
    public $models = null;

    public function getLabel($model)
    {
        if (!empty($model->title)) {
            return $model->title;
        }

        return $model->key;
    }

    public function getOptions($model)
    {
        if (!empty($model->items) && is_array($model->items)) {
            return $model->items;
        }

        return [
            1 => Yii::t('common', 'Yes'),
            0 => Yii::t('common', 'No'),
        ];
    }

    public function setOldAttribute($key, $val)
    {
        $this->oldAttributes[$key] = $val;
    }

    public function getOldAttribute($key, $defaultValue = null)
    {
        if (isset($this->oldAttributes[$key])) {
            return $this->oldAttributes[$key];
        }

        return $defaultValue;
    }

    public function setRules($models)
    {
        $this->models = $models;
        $this->addRule(array_keys($this->attributes), 'safe');

        // Xu ly rule mo rong
        foreach ($this->attributes as $key => $val) {
            $data = $this->models[$key];

            if ($data->type == Setting::TYPE_UPLOAD_IMAGE) {
                $this->addRule([$key], 'file', ['extensions' => ['jpg', 'png', 'gif'], 'maxSize' => 5 * 1024 * 1024]);
                $this->setOldAttribute($key, $data->value);
            }
        }
    }

    public function save()
    {
        $collection = Yii::$app->mongodb->getCollection(Setting::collectionName());

        foreach ($this->attributes as $key => $val) {
            $data = $this->models[$key];

            // Xu ly cac kieu du lieu khac nhau
            if ($data->type == Setting::TYPE_UPLOAD_IMAGE) {
                $uploadedFile = UploadedFile::getInstance($this, $key);
                if ($uploadedFile && $this->validate()) {
                    $filePath = FileHelper::getUploadPath($uploadedFile->name);
                    if ($uploadedFile->saveAs($filePath)) {
                        FileHelper::removeUploaded($this->getOldAttribute($key));
                        $collection->update(['key' => $key], ['value' => FileHelper::getUploadUrl($filePath)]);
                    }
                }

                continue;
            }

            // Cap nhat gia tri vao db
            $collection->update(['key' => $key], ['value' => $val]);
        }
    }

}
