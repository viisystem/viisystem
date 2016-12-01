<?php

namespace vii\widgets;

use vii\helpers\FileHelper;
use vii\helpers\Html;
use vii\helpers\Url;
use kartik\file\FileInput;

class Image extends FileInput
{
    public $attributeSave = 'image';

    public $initialPreview;
    public $initialPreviewConfig;
    public $initialPreviewDelete;

    public function init()
    {
//        if (empty($this->initialPreviewDelete)) {
//            $this->initialPreviewDelete = Url::to(['delete-image', 'id' => $this->model->getId()]);
//        }
        if (empty($this->options['accept'])) {
            $this->options['accept'] = 'image/*';
        }

        $initialPreview = [];
        $initialPreviewConfig = [];
        if ($this->model->{$this->attributeSave} != null) {
            $initialPreview[] = Html::img(FileHelper::getUploadSrc($this->model->{$this->attributeSave}), ['class' => 'file-preview-image']);
            //$initialPreviewConfig[] = ['width' => '120px', 'url' => $this->initialPreviewDelete, 'key' => "fileId-{$this->model->getId()}"];
        }
//
        if (empty($this->pluginOptions)) {
            $this->pluginOptions = [
                'showPreview' => true,
                'showCaption' => true,
                'showRemove' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-secondary',
                'initialPreview' => $initialPreview,
                'initialPreviewConfig' => $initialPreviewConfig,
                'allowedFileExtensions' => ['jpg', 'gif', 'png'],
                'maxFileSize' => '50000', // KB
            ];
        }

        parent::init();
    }
}
