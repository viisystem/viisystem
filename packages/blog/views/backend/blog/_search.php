<?php

use vii\helpers\Html;
use vii\widgets\ActiveForm;
use vii\widgets\Select;

/* @var $this yii\web\View */
/* @var $model app\packages\blog\models\BlogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-search collapse <?= isset($_GET['BlogSearch']) ? 'in' : '' ?>" id="panel-fiter">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'layout' => 'default'
    ]); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'title') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'category')->widget(Select::className(), ['clear' => true, 'data' => $model->getCategory()->getOptions()]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'is_promotion')->widget(Select::className(), ['clear' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'is_active')->widget(Select::className(), ['clear' => true]) ?>
        </div>
    </div>

    <div class="row hidden">
        <div class="col-md-3">
            <?php  echo $form->field($model, 'created_by') ?>
        </div>
        <div class="col-md-3">
            <?php  echo $form->field($model, 'updated_by') ?>
        </div>
        <div class="col-md-3">
            <?php  echo $form->field($model, 'created_at') ?>
        </div>
        <div class="col-md-3">
            <?php  echo $form->field($model, 'updated_at') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('blog', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('blog', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
