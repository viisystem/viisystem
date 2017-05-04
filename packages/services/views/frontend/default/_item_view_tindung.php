<?php
use yii\helpers\Url;
use vii\helpers\ArrayHelper;

$data_bandwith_creadit = ArrayHelper::getValue($model->data_creadit, 'bandwith_creadit');
$money_open_creadit = ArrayHelper::getValue($model->data_creadit, 'money_open_creadit');
$changre_year = ArrayHelper::getValue($model->data_creadit, 'changre_year');
$withdrawal_fee = ArrayHelper::getValue($model->data_creadit, 'withdrawal_fee');
$free_time_rate = ArrayHelper::getValue($model->data_creadit, 'free_time_rate');
$bandwith_creadit = $services->salary * $data_bandwith_creadit;
?>
<tr>
	<td><?= $model->bank ?></td>
	<td><?= Yii::$app->formatter->format($bandwith_creadit, ['decimal', 0]); ?></td>
	<td><?= $free_time_rate ?></td>
	<td><?= Yii::$app->formatter->format($money_open_creadit, ['decimal', 0]); ?></td>
	<td><?= Yii::$app->formatter->format($withdrawal_fee, ['decimal', 0]); ?>%</td>
	<td><?= Yii::$app->formatter->format($changre_year, ['decimal', 0]); ?></td>
</tr>