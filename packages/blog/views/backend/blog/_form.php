<?php

use vii\helpers\Html;

use vii\widgets\ActiveForm;
use vii\widgets\Image;
use vii\widgets\Tags;
use vii\widgets\Tinymce;

use kartik\widgets\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\packages\blog\models\Blog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-form">
    <div class="row m-b-sm">
        <div class="col-lg-12">
            <div class="btn-group pull-right">
                <?= Html::a(Yii::t('common', 'Save'), 'javascript:', ['class' => 'btn btn-success', 'onclick' => '$("#form-main").submit()']) ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?= Yii::t('setting', 'Information') ?></h5>
                    <div class="ibox-tools">
                        <?= Html::a(Yii::t('common', 'Save'), 'javascript:', ['class' => 'btn btn-xs btn-primary pull-right', 'onclick' => '$("#form-main").submit()']) ?>
                    </div>
                </div>
                <div class="ibox-content">
                    <?php $form = ActiveForm::begin(); ?>

                    <div data-class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#form-general"><?= Yii::t('common', 'General') ?></a></li>
                            <li class=""><a data-toggle="tab" href="#form-category"><?= Yii::t('common', 'Category') ?></a></li>
                            <li class=""><a data-toggle="tab" href="#form-seo"><?= Yii::t('common', 'SEO') ?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="form-general" class="tab-pane active">
                                <div class="panel-body">
                                    <?= $form->field($model, 'title') ?>

                                    <?= $form->field($model, 'image_form')->widget(Image::className()) ?>

                                    <?php //= $form->field($model, 'cover') ?>

                                    <?php //= $form->field($model, 'gallery') ?>

                                    <?= $form->field($model, 'content')->widget(Tinymce::className()) ?>

                                    <?= $form->field($model, 'excerpt')->textarea(['row' => 3]) ?>

                                    <?= $form->field($model, 'skin') ?>

                                    <?= $form->field($model, 'sort') ?>

                                    <?= $form->field($model, 'tags')->widget(Tags::className()) ?>

                                    <?= $form->field($model, 'is_promotion')->widget(SwitchInput::className()) ?>

                                    <?= $form->field($model, 'is_active')->widget(SwitchInput::className()) ?>
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

                                    <?= $form->field($model, 'seo_title') ?>

                                    <?= $form->field($model, 'seo_keyword') ?>

                                    <?= $form->field($model, 'seo_description') ?>
                                </div>
                            </div>
                        </div>


                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
