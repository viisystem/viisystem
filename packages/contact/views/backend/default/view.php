<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\contact\models\Contact */

$this->title = Yii::t('contact', 'Contact');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?= Html::encode($this->title) ?></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        'fullname',
                                        'phone',
                                        'email',
                                        'content',
                                    ],
                                    'options' => ['class' => 'table table-borderless vii-detail-view'],
                                ]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
