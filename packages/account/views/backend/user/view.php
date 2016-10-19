<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = Yii::t('account', 'User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('account', 'Users'), 'url' => ['index']];
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
					<p style="text-align:right">
						<?= Html::a(Yii::t('account', 'Update'), ['update', 'id' => (string)$model->_id], ['class' => 'btn btn-primary']) ?>
						<?= Html::a(Yii::t('account', 'Delete'), ['delete', 'id' => (string)$model->_id], [
							'class' => 'btn btn-danger',
							'data' => [
								'confirm' => Yii::t('account', 'Are you sure you want to delete this item?'),
								'method' => 'post',
							],
						]) ?>
					</p>
					<div class="table-responsive">
						<?= DetailView::widget([
							'model' => $model,
							'attributes' => [
								'_id',
								'username',
								'password',
								'name',
								'birth_date',
								'gender',
								'emails',
								'addresses',
								'description',
								'auth_key',
								'token',
								'created_date',
								'updated_date',
								'last_login_datetime',
								'data',
							],
						]) ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
