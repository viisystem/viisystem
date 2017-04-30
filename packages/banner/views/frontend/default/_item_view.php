<?php
$money_rate = $services->borrow_money * (($model->rate / 100) / 12);
$current_price = $services->borrow_money / $services->borrow_time;
?>
<tr>
	<td><?= $model->bank ?></td>
	<td class="hidden-sm"><?= $model->rate_special ?>%</td>
	<td class="hidden-sm"><?= $model->rate ?>%</td>
	<td><?= Yii::$app->formatter->format($money_rate, ['decimal', 0]); ?></td>
	<td><?= Yii::$app->formatter->format($current_price, ['decimal', 0]); ?></td>
	<td><?= Yii::$app->formatter->format($money_rate + $current_price, ['decimal', 0]); ?></td>
</tr>