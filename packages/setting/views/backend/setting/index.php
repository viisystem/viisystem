<?php

use app\packages\setting\models\Setting;

use vii\helpers\Html;
use vii\helpers\FileHelper;

use vii\widgets\ActiveForm;
use vii\widgets\Tinymce;

use kartik\widgets\SwitchInput;
use kartik\widgets\DateTimePicker;
use kartik\widgets\ColorInput;
use kartik\widgets\FileInput;


/* @var $this yii\web\View */
/* @var $model app\packages\setting\models\SettingModel */

$this->title = Yii::t('setting', 'Settings');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrapper wrapper-content">
    <div class="row m-b-sm">
        <div class="col-lg-6">
            <div class="btn-group">
                <?= Html::a(Yii::t('common', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="btn-group pull-right">
                <?= Html::a(Yii::t('common', 'Save'), 'javascript:', ['class' => 'btn btn-success', 'onclick' => '$("#form-setting").submit()']) ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?= Yii::t('setting', 'Settings') ?></h5>
                </div>
                <div class="ibox-content">
                    <?php $form = ActiveForm::begin([
                        'layout' => 'horizontal',
                        'options' => [
                            'enctype' => 'multipart/form-data',
                            'id' => 'form-setting'
                        ]
                    ]); ?>

                    <?php foreach ($model->attributes as $key => $val) {
                        $data = $models[$key];
                        $field = $form->field($model, $key);

                        if ($data->type == Setting::TYPE_TEXT) {

                        } else if ($data->type == Setting::TYPE_NUMBER) {
                            $field->textInput(['type' => 'number', 'step' => 'any']);
                        } else if ($data->type == Setting::TYPE_TEXTAREA) {
                            $field->textarea(['rows' => 5]);
                        } else if ($data->type == Setting::TYPE_EDITOR) {
                            $field->widget(Tinymce::className());
                        } else if ($data->type == Setting::TYPE_BOOLEAN) {
                            $field->widget(SwitchInput::className());
                        } else if ($data->type == Setting::TYPE_RADIO) {
                            $field->radioList($model->getOptions($data));
                        } else if ($data->type == Setting::TYPE_CHECKBOX) {
                            $field->checkboxList($model->getOptions($data));
                        } else if ($data->type == Setting::TYPE_DROPDOWN) {
                            $field->dropDownList($model->getOptions($data));
                        } else if ($data->type == Setting::TYPE_DATETIME) {
                            $field->widget(DateTimePicker::className());
                        } else if ($data->type == Setting::TYPE_COLOR_PICKER) {
                            $field->widget(ColorInput::className());
                        } else if ($data->type == Setting::TYPE_UPLOAD_IMAGE) {
                            $initialPreview = [];
                            $initialPreviewConfig = [];
                            if ($model->$key != null) {
                                $initialPreview[] = Html::img(FileHelper::getUploadSrc($model->$key), ['class' => 'file-preview-image', 'style' => 'max-height:200px']);
                            }

                            $field->widget(FileInput::className(), [
                                'options' => [
                                    'accept' => 'image/*'
                                ],
                                'pluginOptions' => [
                                    'showPreview' => true,
                                    'showCaption' => true,
                                    'showRemove' => false,
                                    'showUpload' => false,
                                    'browseClass' => 'btn btn-default',
                                    'initialPreview' => $initialPreview,
                                    //'initialPreviewConfig' => $initialPreviewConfig,
                                    'allowedFileExtensions' => ['jpg', 'gif', 'png'],
                                    'maxFileSize' => '50000', // KB
                                ]
                            ]);
                        }

                        echo $field->label($model->getLabel($data) . ' ' . Html::a('', ['update', 'id' => (string) $data->_id], ['class' => 'glyphicon glyphicon-cog m-l-xs']));
                    } ?>


                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
