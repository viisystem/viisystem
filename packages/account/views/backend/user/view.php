<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = Yii::t('account', 'User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('account', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\app\packages\account\bundles\PermissionAsset::register($this);
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
						<a data-toggle="modal" class="btn btn-default" href="<?=yii\helpers\Url::to(['/account/backend/assignment', 'user'=>strval($model->_id)])?>" data-target="#myModal">Assign</a>
						<?= Html::a(Yii::t('account', 'Update'), ['update', 'id' => (string)$model->_id], ['class' => 'btn btn-primary']) ?>
						<?= Html::a(Yii::t('account', 'Delete'), ['delete', 'id' => (string)$model->_id], [
							'class' => 'btn btn-danger',
							'data' => [
								'confirm' => Yii::t('account', 'Are you sure you want to delete this item?'),
								'method' => 'post',
							],
						]) ?>
					</p>
					
					<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									 <h4 class="modal-title">Assignment</h4>
								</div>
								<div class="modal-body"><div class="te"></div></div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<?php //<button type="button" class="btn btn-primary">Save changes</button> ?>
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
					
					<div class="row">
						<div class="col-md-6">
							<div class="table-responsive">
								<?= DetailView::widget([
									'model' => $model,
									'attributes' => [
										'username',
										'password',
										'displayName',
										'birth_date',
										'gender',
										'description',
									],
									'options' => ['class' => 'table table-borderless vii-detail-view'],
								]) ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="table-responsive">
								<?= DetailView::widget([
									'model' => $model,
									'attributes' => [
										'displayEmails',
										'displayAddresses',
										'auth_key',
										'token',
										//'created_date',
										//'updated_date',
										'last_login_datetime',
										//'data',
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
