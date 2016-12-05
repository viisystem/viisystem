<?php

use vii\helpers\Url;

use vii\widgets\ActiveForm;
use vii\widgets\Image;
use vii\widgets\Tinymce;

use kartik\widgets\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\packages\category\models\Category */
/* @var $form yii\widgets\ActiveForm */

\vii\assets\NestsortableAsset::register($this);

$this->title = Yii::t('category', 'Update Category') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('category', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => (string) $model->_id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');

$gridId = 'category-grid';
$controllerId = Yii::$app->controller->controllerId;
?>

<div class="blog-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="tabs-container">
        <div class="pull-right">
            <a class="btn btn-info" href="<?= Yii::$app->request->getQueryParam('returnUrl', Url::to(['index'])) ?>"><?= Yii::t('common', 'Cancel') ?></a>
            <button class="btn btn-primary" type="submit" value="back" name="action"><?=  Yii::t('common', 'Save') ?></button>
        </div>

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#form-general"><?= Yii::t('common', 'General') ?></a></li>
            <li class=""><a data-toggle="tab" href="#form-seo"><?= Yii::t('common', 'SEO') ?></a></li>
        </ul>
        <div class="tab-content">
            <div id="form-general" class="tab-pane active">
                <div class="panel-body">

                    <?= $form->field($model, 'title') ?>

                    <?= $form->field($model, 'description')->textarea(['row' => 3]) ?>

                    <?= $form->field($model, 'content')->widget(Tinymce::className()) ?>

                    <?= $form->field($model, 'classes') ?>

                    <?= $form->field($model, 'skin') ?>

                    <?= $form->field($model, 'is_promotion')->widget(SwitchInput::className()) ?>

                    <?= $form->field($model, 'is_active')->widget(SwitchInput::className()) ?>
                </div>
            </div>
            <div id="form-seo" class="tab-pane">
                <div class="panel-body">
                    <?= $form->field($model, 'slug') ?>

                    <?= $form->field($model, 'meta_title') ?>

                    <?= $form->field($model, 'meta_keyword') ?>

                    <?= $form->field($model, 'meta_description') ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
