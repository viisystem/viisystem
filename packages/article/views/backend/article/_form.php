<?php

use vii\helpers\Url;

use vii\widgets\ActiveForm;
use vii\widgets\Image;
use vii\widgets\Tags;
use vii\widgets\Tinymce;

use kartik\widgets\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\packages\article\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="tabs-container">
        <div class="pull-right">
            <a class="btn btn-info" href="<?= Url::to(['index']) ?>"><?= Yii::t('common', 'Cancel') ?></a>
            <button class="btn btn-primary" type="submit" value="save" name="action"><?=  Yii::t('common', 'Apply') ?></button>
            <button class="btn btn-primary" type="submit" value="back" name="action"><?=  Yii::t('common', 'Save') ?></button>
        </div>

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#form-general"><?= Yii::t('common', 'General') ?></a></li>
            <li class=""><a data-toggle="tab" href="#form-category"><?= Yii::t('common', 'Category') ?></a></li>
            <li class=""><a data-toggle="tab" href="#form-seo"><?= Yii::t('common', 'SEO') ?></a></li>
        </ul>
        <div class="tab-content">
            <div id="form-general" class="tab-pane active">
                <div class="panel-body">
                    <?= $form->field($model, 'title') ?>

                    <?= $form->field($model, 'excerpt')->textarea(['row' => 3]) ?>

                    <?= $form->field($model, 'content')->widget(Tinymce::className()) ?>

                    <?= $form->field($model, 'image_form')->widget(Image::className()) ?>

                    <?= $form->field($model, 'tags')->widget(Tags::className()) ?>

                    <?= $form->field($model, 'skin') ?>

                    <?= $form->field($model, 'sort') ?>

                    <?= $form->field($model, 'is_promotion')->widget(SwitchInput::className()) ?>

                    <?= $form->field($model, 'status')->widget(SwitchInput::className()) ?>
                </div>
            </div>
            <div id="form-category" class="tab-pane">
                <div class="panel-body">
                    <?= $form->field($model, 'category')->checkboxList($model->getCategory()->getOptions()) ?>
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
