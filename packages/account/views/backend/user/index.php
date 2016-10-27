<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('account', 'Users');
$this->params['breadcrumbs'][] = $this->title;
\app\packages\account\bundles\UserAsset::register($this);
?>
<div class="user-index">
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
					<p style="text-align:right">
						<?= Html::a(Yii::t('account', 'Batch'), 'javascript:void(0)', ['class' => 'btn btn-primary', 'onclick'=>new yii\web\JsExpression('User.BatchDelete($("#vii-grid-user"), "'.yii\helpers\Url::to(['/account/backend/user/batch-delete']).'")')]) ?>
						<?= Html::a(Yii::t('account', 'New User'), ['create'], ['class' => 'btn btn-success']) ?>
					</p>
					<div class="table-responsive">
					<?= GridView::widget([
						'options' => [
							'id'=>'vii-grid-user',
						],
						'dataProvider' => $dataProvider,
						'filterModel' => $searchModel,
						'columns' => [
							/*[
								'class' => 'yii\grid\SerialColumn',
								'headerOptions'=>['style'=>'width:30px;'],
							],*/
							[
								'class' => 'yii\grid\CheckboxColumn',
								'headerOptions'=>['style'=>'width:30px;'],
							],
							[
								'attribute'=>'username',
								'headerOptions'=>['style'=>'width:150px;'],
								'format'=>'raw',
								'value'=>function($item){
									return Html::a($item->username,['view', 'id'=> strval($item->_id)]);
								},
							],
							//'password',
							'displayName',
							[
								'attribute'=>'gender',
								'headerOptions'=>['style'=>'width:50px;'],
							],
							[
								'attribute'=>'birth_date',
								'headerOptions'=>['style'=>'width:100px;'],
							],
							// 'emails',
							// 'addresses',
							// 'description',
							// 'auth_key',
							// 'token',
							// 'created_date',
							// 'updated_date',
							// 'last_login_datetime',
							// 'data',

							['class'=>'yii\grid\ActionColumn','headerOptions'=>['style'=>'width:70px;']],
						],
					]); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
