<?php

use vii\helpers\DataHelper;
use vii\helpers\Html;
use vii\helpers\Url;
use vii\widgets\Select;

use yii\bootstrap\ActiveForm;

\vii\assets\NestsortableAsset::register($this);


$gridId = 'category-grid';
$controllerId = Yii::$app->controller->controllerId;

/* @var $this yii\web\View */
/* @var $model app\packages\category\models\Category */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('category', 'Update Category') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('category', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => (string) $model->_id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>

<div class="wrapper wrapper-content">
    <div class="row m-b-sm">
        <div class="col-lg-6">
            <div class="btn-group">
                <?= Html::a(Yii::t('common', 'Create'), 'javascript:', ['class' => 'btn btn-success', 'data-class' => 'body-full', 'data-url' => Url::to(["{$controllerId}/item-create", 'id' => $model->getId()]), 'data-ajax-container' => 'nestsortable-container', 'data-func-success' => 'jurakit.nestsortable.init()', 'onclick' => 'jurakit.form.modal($(this))']) ?>
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
                    <div id="nestsortable-container" class="bg4 nestsortable-container">
                        <?php echo $this->render('/backend/category/itemList', ['model' => $model, 'modelItem' => $model->items]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
