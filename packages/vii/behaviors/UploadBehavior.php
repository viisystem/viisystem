<?php

namespace vii\behaviors;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;
use yii\validators\Validator;
use yii\web\UploadedFile;

use vii\helpers\FileHelper;

class UploadBehavior extends AttributeBehavior
{
    public $attribute = 'image';

    public $uploadAttribute = 'image_form';

    public $uploadTempAttribute = 'image_temp';

    public $uploadAttributeRules = [];

    public $uploadPath = '@runtime/uploads';

    public $autoSave = true;

    public $autoDelete = true;

    public function events()
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            BaseActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
            BaseActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
            BaseActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
        ];
    }

    /**
     * Before validate event.
     */
    public function beforeValidate()
    {
        /** @var $owner \yii\mongodb\ActiveRecord */
        $owner = $this->owner;

        if (is_array($this->uploadAttributeRules) && !empty($this->uploadAttributeRules)) {
            $validators = $owner->validators;
            $validator = Validator::createValidator('image', $owner, (array) $this->uploadAttribute, $this->uploadAttributeRules);
            $validators->append($validator);
        }

        if ($owner->{$this->uploadAttribute} instanceof UploadedFile) {
            return;
        }

        $owner->{$this->uploadAttribute} = UploadedFile::getInstance($owner, $this->uploadAttribute);
    }


    public function beforeSave()
    {
        /** @var $owner \yii\mongodb\ActiveRecord */
        $owner = $this->owner;

        // Upload form
        if ($owner->{$this->uploadAttribute} instanceof UploadedFile) {
            if (!$owner->isNewRecord && $owner->{$this->attribute} != null) {
                FileHelper::removeUploaded($owner->{$this->attribute});
            }

            $filePath = FileHelper::getUploadPath($owner->{$this->uploadAttribute}->name);
            if ($owner->{$this->uploadAttribute}->saveAs($filePath)) {
                $owner->{$this->attribute} = FileHelper::getUploadUrl($filePath);
            }

            return true;
        }

        // Upload ajax
        if (isset($owner->{$this->uploadTempAttribute}) && !empty($owner->{$this->uploadTempAttribute})) {
            if (!$owner->isNewRecord && $owner->{$this->attribute} != null) {
                FileHelper::removeUploaded($owner->{$this->attribute});
            }

            $filePath = FileHelper::getUploadPath($owner->{$this->uploadTempAttribute});
            $tempPath = FileHelper::getUploadTempPathExist($owner->{$this->uploadTempAttribute});
            if (file_exists($tempPath) && is_file($tempPath) && copy($tempPath, $filePath)) {
                FileHelper::removeFile($tempPath);
                $owner->{$this->attribute} = FileHelper::getUploadUrl($filePath);
            }

            return true;
        }

        // Remove File
        if ($owner->{$this->attribute} == null && $owner->getOldAttribute($this->attribute) != null) {
            FileHelper::removeUploaded($owner->getOldAttribute($this->attribute));
            return true;
        }
    }

    /**
     * Event handler for beforeDelete
     * @param \yii\base\ModelEvent $event
     */
    public function beforeDelete($event)
    {
        /** @var $owner \yii\mongodb\ActiveRecord */
        $owner = $this->owner;
        if ($owner->{$this->attribute} != null) {
            FileHelper::removeUploaded($owner->{$this->attribute});
        }
    }
}
