<?php
use yii\helpers\Url;
$money_rate = round($services->borrow_money * (($model->rate / 100) / $services->borrow_time));
$current_price = round($services->borrow_money / $services->borrow_time);
?>
<tr>
	<td><?= $model->bank ?></td>
	<td><?= $model->rate_special ?>%</td>
	<td><?= $model->rate ?>%</td>
	<td><?= Yii::$app->formatter->format($money_rate, ['decimal', 0]); ?></td>
	<td><?= Yii::$app->formatter->format($current_price, ['decimal', 0]); ?></td>
	<td><?= Yii::$app->formatter->format($money_rate + $current_price, ['decimal', 0]); ?></td>
	<td><a target="_blank" href="<?= Url::to(['/services/frontend/default/detail', 'bank' => $model->bank, 'rate' => $model->rate, 'rate_special' => $model->rate_special, 'money' => $services->borrow_money, 'time' => $services->borrow_time]) ?>"><span class="label label-warning">Xem Chi Tiết</span></a></td>
</tr>