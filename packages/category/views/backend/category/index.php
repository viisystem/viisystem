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

<div class="category-view">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <div class="ibox-title-rgt">
                <a class="btn btn-primary" href="javascript:" data-class="body-full" data-url="<?= Url::to(["{$controllerId}/item-create", 'id' => $model->getId()]) ?>" data-ajax-container="nestsortable-container" data-func-success="jurakit.nestsortable.init()" onclick="jurakit.form.modal($(this)); return false"><?= Yii::t('common', 'Create') ?></a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="ibox-content">
            <div id="nestsortable-container" class="nestsortable-container">
                <?= $this->render('itemList', ['model' => $model, 'modelItem' => $model->items]) ?>
            </div>
        </div>
    </div>
</div>
