<?php

use vii\helpers\DataHelper;
use vii\helpers\Html;

use vii\widgets\ActiveForm;
use vii\widgets\Select;


$gridId = 'category-grid';
$controllerId = Yii::$app->controller->controllerId;

/* @var $this yii\web\View */
/* @var $model app\packages\category\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wrapper wrapper-content">
    <div class="row m-b-sm">
        <div class="col-lg-12">
            <div class="btn-group pull-right">
                <?= Html::a(Yii::t('common', 'Save'), 'javascript:', ['class' => 'btn btn-success', 'onclick' => '$("#form-default").submit()']) ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?= Yii::t('setting', 'Information') ?></h5>
                </div>
                <div class="ibox-content">
                    <?php $form = ActiveForm::begin([
                        'layout' => 'horizontal',
                        'options' => [
                            'id' => 'form-default'
                        ]
                    ]); ?>

                    <?= $form->field($model, 'language')->widget(Select::className(), ['data' => DataHelper::getLanguageOptions()]) ?>

                    <?= $form->field($model, 'key') ?>
                    
                    <?= $form->field($model, 'title') ?>

                    <?= $form->field($model, 'is_active')->widget(Select::className()) ?>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

