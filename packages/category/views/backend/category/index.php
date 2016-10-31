<?php

use vii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

\vii\assets\NestsortableAsset::register($this);

$gridId = 'category-grid';
$moduleId = Yii::$app->controller->module->id;
$controllerId = Yii::$app->controller->controllerId;
$categoryTitle = Yii::$app->controller->categoryTitle;

$title = Yii::t('category', 'Manage Category');
if ($categoryTitle != null) {
    $title = Yii::t($moduleId, $categoryTitle);
}

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => Yii::t($moduleId, 'Module Name'), 'url' => ["/{$moduleId}/default/index"]];
$this->params['breadcrumbs'][] = $title;
?>

<div class="wrapper wrapper-content">
    <div class="row m-b-sm">
        <div class="col-lg-6">
            <div class="btn-group">
                <a class="btn btn-success" href="javascript:" data-class="body-full" data-url="<?= Url::to(["{$controllerId}/item-create", 'id' => $model->getId()]) ?>" data-ajax-container="nestsortable-container" data-func-success="jurakit.nestsortable.init()" onclick="jurakit.form.modal($(this)); return false"><?= Yii::t('common', 'Create') ?></a>

                <?php //= \app\packages\category\widgets\backend\LanguageSwitcher::widget() ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?= Yii::t('category', 'Categories') ?></h5>
                </div>
                <div class="ibox-content">
                    <div id="nestsortable-container" class="nestsortable-container">
                        <?= $this->render('itemList', ['model' => $model, 'modelItem' => $model->items]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
