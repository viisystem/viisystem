<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
?>
<?php
$form = ActiveForm::begin([
            'layout' => 'horizontal',
            'options' => ['enctype' => 'multipart/form-data'],
            'fieldConfig' => [
                'horizontalCssClasses' => [
                    'label' => '',
                    'offset' => '',
                    'wrapper' => 'col-sm-12',
                    'error' => 'help-block m-b-none',
                    'hint' => 'hr-line-dashed',
                ],
            ],
        ]);
?>
<div class="row">
    <div class="col-md-6">
        <div id="nestable-menu">
            <button class="btn btn-info" name="saveAssign" type="submit">&nbsp;<?= Yii::t('common', 'Save') ?></button>
            <a href="<?= Url::to(['backend/default']) ?>" class="btn btn-info ">&nbsp;<?= Yii::t('common', 'Back') ?></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= Yii::t('account', 'Role By User') ?></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <?= \kartik\select2\Select2::widget([
                    'name' => 'permission',
                    'data' => $items,
                    'value' => $assignmentsByUser,
                    'options' => [
                        'placeholder' => 'Select permission ...',
                        'multiple' => true,
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div id="nestable-menu">
            <button class="btn btn-info" name="saveAssign" type="submit">&nbsp;<?= Yii::t('common', 'Save') ?></button>
            <a href="<?= Url::to(['backend/default']) ?>" class="btn btn-info ">&nbsp;<?= Yii::t('common', 'Back') ?></a>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>