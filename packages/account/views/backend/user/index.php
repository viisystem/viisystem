<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('account', 'Users');
$this->params['breadcrumbs'][] = $this->title;
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
						<?= Html::a(Yii::t('account', 'New User'), ['create'], ['class' => 'btn btn-success']) ?>
					</p>
					<div class="table-responsive">
					<?= GridView::widget([
						'dataProvider' => $dataProvider,
						'filterModel' => $searchModel,
						'columns' => [
							['class' => 'yii\grid\SerialColumn'],

							'_id',
							'username',
							'password',
							'name',
							'birth_date',
							// 'gender',
							// 'emails',
							// 'addresses',
							// 'description',
							// 'auth_key',
							// 'token',
							// 'created_date',
							// 'updated_date',
							// 'last_login_datetime',
							// 'data',

							['class' => 'yii\grid\ActionColumn'],
						],
					]); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
