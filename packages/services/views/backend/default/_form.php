<?php

use vii\helpers\Url;

use vii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use app\packages\services\models\Services;

/* @var $this yii\web\View */
/* @var $model app\packages\services\models\Services */
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
        </ul>
        <div class="tab-content">
            <div id="form-general" class="tab-pane active">
                <div class="panel-body">
                    <?= $form->field($model, 'title') ?>

                    <?= $form->field($model, 'type')->widget(kartik\widgets\Select2::classname(), [
                        'data' => Services::getInstance()->arrType,
                        'options' => ['id' => 'type_bank', 'onchange' => 'changeType(this);'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]) ?>

                    <?= $form->field($model, 'bank') ?>
                    
                    <div class="data_bank type_default">
                        <?= $form->field($model, 'rate') ?>

                        <?= $form->field($model, 'rate_special') ?>
                    </div>

                    <div class="data_bank type_creadit">
                        <?= $form->field($model, 'data_creadit[bandwith_creadit]')->label('Hệ số hạn mức thẻ tối đa') ?>

                        <?= $form->field($model, 'data_creadit[free_time_rate]')->label('Thời gian miễn lãi tối đa (ngày)') ?>

                        <?= $form->field($model, 'data_creadit[money_open_creadit]')->label('Phí mở thẻ (đ)') ?>

                        <?= $form->field($model, 'data_creadit[withdrawal_fee]')->label('Phí rút (%)') ?>

                        <?= $form->field($model, 'data_creadit[changre_year]')->label('Phí thường niên (đ)') ?>
                    </div>

                    <?= $form->field($model, 'status')->widget(SwitchInput::className()) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$this->registerJs("
    $('.data_bank').hide();

    if ($('#type_bank').val() == '" . Services::TYPE_CREDIT_CARD . "') {
        $('.type_creadit').show();
    } else {
        $('.type_default').show();
    }

    function changeType(element) {
        var type_select = $(element).val();
        $('.data_bank').hide();
        if ($(element).val() == '" . Services::TYPE_CREDIT_CARD . "') {
            $('.type_creadit').show();
        } else {
            $('.type_default').show();
        }
    }

", yii\web\View::POS_END);
// End Switchery
?>